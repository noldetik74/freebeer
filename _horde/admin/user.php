<?php
/**
 * $Horde: horde/admin/user.php,v 1.42 2004/02/26 13:02:04 eraserhd Exp $
 *
 * Copyright 1999-2004 Chuck Hagenbuch <chuck@horde.org>
 *
 * See the enclosed file COPYING for license information (LGPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 */

define('HORDE_BASE', dirname(__FILE__) . '/..');
require_once HORDE_BASE . '/lib/base.php';
require_once HORDE_LIBS . 'Horde/Menu.php';
require_once HORDE_LIBS . 'Horde/Form.php';
require_once HORDE_LIBS . 'Horde/Form/Renderer.php';
require_once HORDE_LIBS . 'Horde/Variables.php';

if (!Auth::isAdmin()) {
    Horde::fatal('Forbidden.', __FILE__, __LINE__);
}
$auth = &Auth::singleton($conf['auth']['driver']);

if ($conf['signup']['approve']) {
    require_once HORDE_LIBS . 'Horde/Auth/Signup.php';
    $signup = &Auth_Signup::singleton();
}

$vars = &Variables::getDefaultVariables();
$addForm = &new Horde_Form($vars, _("Add a new user:"), 'adduser');
$addForm->setButtons(_("Add user"), _("Reset"));

$vars->set('form', 'add');
$addForm->addHidden('', 'form', 'text', true, true);
$addForm->addVariable(_("Username"), 'user_name', 'text', true);
$addForm->addVariable(_("Password"), 'password', 'passwordconfirm', false, false, _("type the password twice to confirm"));

/* Use hooks get any extra fields for new accounts. */
$extra = Horde::callHook('_horde_hook_signup_getextra');
if (!is_a($extra, 'PEAR_Error') && !empty($extra)) {
    foreach ($extra as $field_name => $field) {
        $readonly = isset($field['readonly']) ? $field['readonly'] : null;
        $desc = isset($field['desc']) ? $field['desc'] : null;
        $field_params = isset($field['params']) ? $field['params'] : array();

        $addForm->addVariable($field['label'], 'extra[' . $field_name . ']', $field['type'], $field['required'], $readonly, $desc, $field_params);
    }
}


// Process forms. Use Util::getPost() instead of Util::getFormData()
// for a lot of the data because we want to actively ignore GET data
// in some cases - adding/modifying users - as a security precaution.
switch (Util::getFormData('form')) {
case 'add':
    $addForm->validate($vars);

    if ($addForm->isValid() && $vars->get('formname') == 'adduser') {
        $addForm->getInfo($vars, $info);

        if (empty($info['user_name'])) {
            $notification->push(_("You must specify the username to add."), 'horde.error');

        } else {
            $credentials = array('password' => $info['password']);
            if (isset($info['extra'])) {
                foreach ($info['extra'] as $field => $value) {
                    $credentials[$field] = $value;
                }
            }

            if (is_a($ret = $auth->addUser($info['user_name'], $credentials), 'PEAR_Error')) {
                $notification->push(sprintf(_("There was a problem adding '%s' to the system: %s"), $info['user_name'], $ret->getMessage()), 'horde.error');
            } else {
                if (isset($info['extra'])) {
                    $result = Horde::callHook('_horde_hook_signup_addextra',
                                              array($info['user_name'], $info['extra']));
                    if (is_a($result, 'PEAR_Error')) {
                        $notification->push(sprintf(_("Added '%s' to the system, but could not add additional signup information: %s."), $info['user_name'], $result->getMessage()), 'horde.warning');
                    }
                }
                if (Util::getFormData('removeQueuedSignup')) {
                    $signup->removeQueuedSignup($info['user_name']);
                }
                $notification->push(sprintf(_("Successfully added '%s' to the system."), $info['user_name']), 'horde.success');
                $addForm->unsetVars($vars);
            }
        }
    }
    break;

case 'remove_f':
    $f_user_name = Util::getFormData('user_name');
    $remove_form = true;
    break;

case 'remove':
    $f_user_name = Util::getFormData('user_name');
    if (empty($f_user_name)) {
        $notification->push(_("You must specify a username to remove."), 'horde.message');
    } elseif (Util::getFormData('submit') !== _("Cancel")) {
        if (is_a($result = $auth->removeUser($f_user_name), 'PEAR_Error')) {
            $notification->push(sprintf(_("There was a problem removing '%s' from the system: ") . $result->getMessage(), $f_user_name), 'horde.error');
        } else {
            $notification->push(sprintf(_("Successfully removed '%s' from the system."), $f_user_name), 'horde.success');
        }
    }
    break;

case 'update_f':
    $f_user_name = Util::getFormData('user_name');
    $update_form = true;
    break;

case 'update':
    $user_name_1 = Util::getPost('user_name');
    $user_name_2 = Util::getPost('user_name2', $user_name_1);
    $fullname = Util::getPost('user_fullname');
    $email = Util::getPost('user_email');

    if ($auth->hasCapability('update')) {
        $user_pass_1 = Util::getPost('user_pass_1');
        $user_pass_2 = Util::getPost('user_pass_2');

        if (empty($user_name_1)) {
            $notification->push(_("You must specify the username to update."), 'horde.error');
        } elseif (empty($user_pass_1) || empty($user_pass_2)) {
            // Don't update, but don't complain.
        } elseif ($user_pass_1 != $user_pass_2) {
            $notification->push(_("Passwords must match."), 'horde.error');
        } else {
            $result = $auth->updateUser($user_name_1,
                                        $user_name_2,
                                        array('password' => $user_pass_1));
        }
    }

    if (isset($result) && is_a($result, 'PEAR_Error')) {
        $notification->push(sprintf(_("There was a problem updating '%s': %s"),
                                    $user_name_1, $result->getMessage()), 'horde.error');
    } else {
        require_once HORDE_LIBS . 'Horde/Identity.php';
        $identity = &Identity::singleton('none', $user_name_1);
        $identity->setValue('fullname', $fullname);
        $identity->setValue('from_addr', $email);
        $identity->save();

        $notification->push(sprintf(_("Successfully updated '%s'"),
                                    $user_name_2), 'horde.success');
    }
    break;

case 'approve_f':
    $thisSignup = $signup->getQueuedSignup(Util::getFormData('user_name'));
    $info = $thisSignup->getData();

    $vars->set('password',
                  array('original' => $info['password'],
                        'confirm' => $info['password']));
    unset($info['password']);
    $vars->set('extra', $info);

    $vars->set('removeQueuedSignup', true);
    $addForm->addHidden('', 'removeQueuedSignup', 'boolean', true);

    break;

case 'removequeued_f':
    $f_user_name = Util::getFormData('user_name'); 
    $removequeued_form = true;
    break;

case 'removequeued':
    $result = $signup->removeQueuedSignup(Util::getFormData('user_name'));
    if (is_a($result, 'PEAR_Error')) {
        $notification->push($result);
    } else {
        $notification->push(sprintf(_("The signup request for %s has been removed."), Util::getFormData('user_name')));
    }
    break;
}


$title = _("User Administration");
require HORDE_TEMPLATES . '/common-header.inc';
require HORDE_TEMPLATES . '/admin/common-header.inc';
$notification->notify(array('listeners' => 'status'));

if (isset($update_form) && $auth->hasCapability('list')) {
    require_once HORDE_LIBS . 'Horde/Identity.php';
    $identity = &Identity::singleton('none', $f_user_name);
    require HORDE_TEMPLATES . '/admin/user/update.inc';
} elseif (isset($remove_form) && $auth->hasCapability('list') && $auth->hasCapability('remove')) {
    require HORDE_TEMPLATES . '/admin/user/remove.inc';
} elseif (isset($removequeued_form)) {
    require HORDE_TEMPLATES . '/admin/user/removequeued.inc';
} elseif ($auth->hasCapability('add')) {
    require HORDE_TEMPLATES . '/admin/user/add.inc';
    if ($conf['signup']['approve']) {
        require HORDE_TEMPLATES . '/admin/user/approve.inc';
    }
} else {
    require HORDE_TEMPLATES . '/admin/user/noadd.inc';
}

if ($auth->hasCapability('list')) {
    $users = $auth->listUsers();
    if (is_a($users, 'PEAR_Error')) {
        Horde::fatal($users, __FILE__, __LINE__);
    }
    require HORDE_TEMPLATES . '/admin/user/list.inc';
} else {
    require HORDE_TEMPLATES . '/admin/user/nolist.inc';
}

require HORDE_TEMPLATES . '/common-footer.inc';

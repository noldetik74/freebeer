<?php

// $CVSHeader: _freebeer/www/tests/index.php,v 1.3 2004/03/07 17:51:36 ross Exp $

// Copyright (c) 2002-2004, Ross Smith.  All rights reserved.
// Licensed under the BSD or LGPL License. See license.txt for details.

error_reporting(2047);
@set_time_limit(0);

defined('FREEBEER_BASE') || define('FREEBEER_BASE', getenv('FREEBEER_BASE') ? getenv('FREEBEER_BASE') :
	dirname(dirname(dirname(__FILE__))));

require_once FREEBEER_BASE . '/lib/Pear/Pear.php';

require_once FREEBEER_BASE . '/lib/HTTP.php';

fbHTTP::sendLastModified();

require_once 'PHPUnit.php';
require_once 'PHPUnit/GUI/HTML.php';
require_once 'PHPUnit/GUI/SetupDecorator.php';

/// \todo rewrite to fbTestSuite class
// called via:
// fbTestSuite(array(['dir1', 'dir2', .... ]));

$gui = &new PHPUnit_GUI_SetupDecorator(new PHPUnit_GUI_HTML());

chdir(FREEBEER_BASE . '/tests') ||
trigger_error(sprintf('Can\'t change directory to \'%s\'', FREEBEER_BASE . '/tests'), E_USER_ERROR);
$gui->getSuitesFromDir('.', '^Test.*\.php$');
error_reporting(0);
$gui->show();

?>
 

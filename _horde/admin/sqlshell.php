<?php
/**
 * $Horde: horde/admin/sqlshell.php,v 1.14 2004/02/14 01:36:13 chuck Exp $
 *
 * Copyright 1999-2004 Chuck Hagenbuch <chuck@horde.org>
 *
 * See the enclosed file COPYING for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 */

define('HORDE_BASE', dirname(__FILE__) . '/..');
require_once HORDE_BASE . '/lib/base.php';
require_once HORDE_LIBS . 'Horde/Menu.php';
require_once HORDE_LIBS . 'Horde/Help.php';
require_once 'DB.php';

if (!Auth::isAdmin()) {
    Horde::fatal('Forbidden.', __FILE__, __LINE__);
}

$title = _("SQL Shell");
require HORDE_TEMPLATES . '/common-header.inc';
require HORDE_TEMPLATES . '/admin/common-header.inc';

?>
<form name="sqlshell" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
<?php Util::pformInput() ?>

<?php
if ($command = trim(Util::getFormData('sql'))) {
    // Keep a cache of prior queries for convenience.
    if (!isset($_SESSION['_sql_query_cache'])) {
        $_SESSION['_sql_query_cache'] = array();
    }
    if (($key = array_search($command, $_SESSION['_sql_query_cache'])) !== false) {
        unset($_SESSION['_sql_query_cache'][$key]);
    }
    array_unshift($_SESSION['_sql_query_cache'], $command);
    while (count($_SESSION['_sql_query_cache']) > 20) {
        array_pop($_SESSION['_sql_query_cache']);
    }

    echo '<div class="header">' . _("SQL Query") . ':</div><br />';
    echo '<table cellpadding="4" border="0"><tr><td class="text"><pre>' . htmlspecialchars($command) . '</pre></td></tr></table>';

    echo '<br /><div class="header">' . _("Results") . ':</div><br />';
    echo '<table cellpadding="2" border="0"><tr><td class="control">';

    // Parse out the query results.
    $dbh = &DB::connect($conf['sql']);
    if (is_a($dbh, 'PEAR_Error')) {
        echo '<pre>'; var_dump($dbh); echo '</pre>';
    } else {
        $result = $dbh->query(String::convertCharset($command, NLS::getCharset(), $conf['sql']['charset']));
        if (is_a($result, 'PEAR_Error')) {
            echo '<pre>'; var_dump($result); echo '</pre>';
        } else {
            if (is_object($result)) {
                echo '<table border="0" cellpadding="1" cellspacing="1">';
                $first = true;
                $i = 0;
                while ($row = $result->fetchRow(DB_FETCHMODE_ASSOC)) {
                    if ($first) {
                        echo '<tr>';
                        foreach ($row as $key => $val) {
                            echo '<th align="left">' . (empty($key) ? '&nbsp;' : htmlspecialchars(String::convertCharset($key, $conf['sql']['charset']))) . '</th>';
                        }
                        echo '</tr>';
                        $first = false;
                    }
                    echo '<tr class="item' . ($i % 2) . '">';
                    foreach ($row as $val) {
                        echo '<td class="fixed">' . (empty($val) ? '&nbsp;' : htmlspecialchars(String::convertCharset($val, $conf['sql']['charset']))) . '</td>';
                    }
                    echo '</tr>';
                    $i++;
                }
                echo '</table>';
            } else {
                echo '<b>' . _("Success") . '</b>';
            }
        }
    }

    echo '</td></tr></table><br />';
}
?>

<?php if (array_key_exists('_sql_query_cache', $_SESSION) &&
          count($_SESSION['_sql_query_cache'])): ?>
  <select name="query_cache" onchange="document.sqlshell.sql.value = document.sqlshell.query_cache[document.sqlshell.query_cache.selectedIndex].value;">
  <?php foreach ($_SESSION['_sql_query_cache'] as $query): ?>
    <option value="<?php echo htmlspecialchars($query) ?>"><?php echo htmlspecialchars($query) ?></option>
  <?php endforeach; ?>
  </select>
  <input type="button" value="<?php echo _("Paste") ?>" class="button" onclick="document.sqlshell.sql.value = document.sqlshell.query_cache[document.sqlshell.query_cache.selectedIndex].value;" />
  <input type="button" value="<?php echo _("Run") ?>" class="button" onclick="document.sqlshell.sql.value = document.sqlshell.query_cache[document.sqlshell.query_cache.selectedIndex].value; document.sqlshell.submit();" />
  <br />
<?php endif; ?>

<textarea class="fixed" name="sql" rows="10" cols="60" wrap="hard">
<?php if (!empty($command)) echo htmlspecialchars($command) ?></textarea>
<br />
<input type="submit" class="button" value="<?php echo _("Execute") ?>">
<?php if ($conf['user']['online_help'] && $browser->hasFeature('javascript')): ?>
    <?php Help::javascript(); ?>
    <td class="header" align="right"><?php echo Help::link('admin', 'admin-sqlshell') ?></td>
<?php endif; ?>

</form>
<?php

require HORDE_TEMPLATES . '/common-footer.inc';

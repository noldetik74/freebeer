<?php

/**
 * Local error callback handler.
 *
 * Drops the phptest table, prints out an error message and kills the
 * process.
 *
 * @param object  $o  PEAR error object automatically passed to this method
 * @return void
 * @see PEAR::setErrorHandling()
 */
function pe($o) {
    global $dbh;

    $dbh->setErrorHandling(PEAR_ERROR_RETURN);
    $dbh->query('DROP TABLE phptest');

    die($o->toString());
}

$dbh->setErrorHandling(PEAR_ERROR_CALLBACK, 'pe');


$sth = $dbh->simpleQuery("SELECT * FROM phptest");

switch ($dbh->phptype) {
    case 'mysqli':
        if (is_a($sth, 'mysqli_result')) {
            print "passed\n";
        } else {
            print "PROBLEM\n";
        }
        break;
    default:
        if (gettype($sth) == 'resource') {
            print "passed\n";
        } else {
            print "PROBLEM\n";
        }
}


switch ($dbh->phptype) {
    case 'ibase':
        /*
         * Interbase doesn't allow dropping tables that have result
         * sets still open.
         */
        $dbh->freeResult($sth);
        break;
}
$dbh->setErrorHandling(PEAR_ERROR_RETURN);
$dbh->query('DROP TABLE phptest');

?>

<?php

function errhandler($obj)
{
    if ($obj->getCode() == DB_ERROR) {
        print '  unknown: ' . $obj->getUserInfo()."\n";
    } else {
        $msg = $obj->getMessage();
        print "  $msg";
        if (substr($msg, -1) != "\n") {
            print "\n";
        }
    }
}

$dbh->setErrorHandling(PEAR_ERROR_CALLBACK, "errhandler");


print "Trying to provoke DB_ERROR_NOSUCHTABLE\n";
$dbh->query('SELECT * FROM tableThatsBogus');

print "Trying to provoke DB_ERROR_ALREADY_EXISTS for create table\n";
$dbh->query($test_mktable_query);

print "Trying to provoke DB_ERROR_NOSUCHTABLE\n";
$dbh->query('DROP TABLE tableThatsBogus');


print "Trying to provoke DB_ERROR_CONSTRAINT for primary key insert duplicate\n";
$dbh->setErrorHandling(PEAR_ERROR_RETURN);
$dbh->query('DROP TABLE a');
$dbh->setErrorHandling(PEAR_ERROR_CALLBACK, 'errhandler');
$dbh->query('CREATE TABLE a (a INTEGER NOT NULL, PRIMARY KEY (a))');
$dbh->query('INSERT INTO a VALUES (1)');
$dbh->query('INSERT INTO a VALUES (1)');

print "Trying to provoke DB_ERROR_CONSTRAINT for primary key update duplicate\n";
$dbh->query('INSERT INTO a VALUES (2)');
$dbh->query('UPDATE a SET a=1 WHERE a=2');


print "Trying to provoke DB_ERROR_CONSTRAINT for unique key insert duplicate\n";
$dbh->setErrorHandling(PEAR_ERROR_RETURN);
$dbh->query('DROP TABLE a');
$dbh->setErrorHandling(PEAR_ERROR_CALLBACK, 'errhandler');
$dbh->query('CREATE TABLE a (a INTEGER NOT NULL, UNIQUE (a))');
$dbh->query('INSERT INTO a VALUES (1)');
$dbh->query('INSERT INTO a VALUES (1)');

print "Trying to provoke DB_ERROR_CONSTRAINT for unique key update duplicate\n";
$dbh->query('INSERT INTO a VALUES (2)');
$dbh->query('UPDATE a SET a=1 WHERE a=2');


print "Trying to provoke DB_ERROR_CONSTRAINT for foreign key on insert\n";
$dbh->setErrorHandling(PEAR_ERROR_RETURN);
$dbh->query('DROP TABLE b');
$dbh->query('DROP TABLE a');
$dbh->setErrorHandling(PEAR_ERROR_CALLBACK, 'errhandler');
switch ($dbh->phptype) {
    case 'mysql':
    case 'mysqli':
        $dbh->query('CREATE TABLE a (a INT NOT NULL, '
                    . 'PRIMARY KEY (a)) '
                    . 'TYPE=INNODB');
        $dbh->query('CREATE TABLE b (b INT, '
                    . 'INDEX par_ind (b), '
                    . 'FOREIGN KEY (b) REFERENCES a (a)) '
                    . 'TYPE=INNODB');
        break;
    default:
        $dbh->query('CREATE TABLE a (a INTEGER NOT NULL, PRIMARY KEY (a))');
        $dbh->query('CREATE TABLE b (b INTEGER REFERENCES a (a))');
}
$dbh->query('INSERT INTO a (a) values (1)');
$dbh->query('INSERT INTO b (b) values (2)');
switch ($dbh->phptype) {
    case 'sqlite':
        print "            OK  $dbh->phptype doesn't consider this an error\n";
        break;
}

print "Trying to provoke DB_ERROR_CONSTRAINT for foreign key on delete\n";
$dbh->query('INSERT INTO b (b) values (1)');
$dbh->query('DELETE FROM a WHERE a = 1');
switch ($dbh->phptype) {
    case 'sqlite':
        print "            OK  $dbh->phptype doesn't consider this an error\n";
        break;
}


print "Trying to provoke DB_ERROR_CONSTRAINT_NOT_NULL on insert\n";
$dbh->setErrorHandling(PEAR_ERROR_RETURN);
$dbh->query('DROP TABLE peartestnull');
$dbh->setErrorHandling(PEAR_ERROR_CALLBACK, 'errhandler');
$dbh->query('CREATE TABLE peartestnull (a CHAR(3) NOT NULL)');
$dbh->query('INSERT INTO peartestnull VALUES (NULL)');

print "Trying to provoke DB_ERROR_CONSTRAINT_NOT_NULL on update\n";
$dbh->query("INSERT INTO peartestnull VALUES ('one')");
$dbh->query("UPDATE peartestnull SET a = NULL WHERE a = 'one'");
switch ($dbh->phptype) {
    case 'mysql':
    case 'mysqli':
        print "            OK  $dbh->phptype doesn't consider this an error\n";
        break;
}


print "Trying to provoke DB_ERROR_DIVZERO\n";
// Interbase detects the error on fetching
$dbh->getAll('SELECT 0/0 FROM phptest');
switch ($dbh->phptype) {
    case 'mssql':
    case 'sybase':
        print "            OK  PHP's $dbh->phptype extension doesn't report this error\n";
        break;
    case 'odbc':
        switch ($dbh->dbsyntax) {
            case 'access':
                print "            OK  odbc($dbh->dbsyntax) doesn't report this error\n";
                break;
        }
        break;
    case 'ifx':
    case 'mysql':
    case 'mysqli':
    case 'sqlite':
        print "            OK  $dbh->phptype doesn't consider this an error\n";
        break;
}

print "Trying to provoke DB_ERROR_INVALID_NUMBER\n";
$dbh->query("UPDATE phptest SET a = 'abc' WHERE a = 42");
switch ($dbh->phptype) {
    case 'mysql':
    case 'mysqli':
    case 'sqlite':
        print "            OK  $dbh->phptype doesn't consider this an error\n";
        break;
}

print "Trying to provoke DB_ERROR_NOSUCHFIELD\n";
$dbh->query('SELECT e FROM phptest');

print "Trying to provoke DB_ERROR_SYNTAX\n";
$dbh->query('CREATE');


$dbh->setErrorHandling(PEAR_ERROR_RETURN);
$dbh->query('DROP TABLE phptest');
$dbh->query('DROP TABLE b');
$dbh->query('DROP TABLE a');
$dbh->query('DROP TABLE peartestnull');

?>

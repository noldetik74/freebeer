<?php

// $CVSHeader: _freebeer/tests/HMAC_Login/Test_HMAC_Login_MySQL.php,v 1.3 2004/03/07 17:51:29 ross Exp $

// Copyright (c) 2002-2004, Ross Smith.  All rights reserved.
// Licensed under the BSD or LGPL License. See license.txt for details.

require_once FREEBEER_BASE . '/tests/_init.php';

require_once FREEBEER_BASE . '/tests/Test_HMAC_Login.php';

require_once FREEBEER_BASE . '/lib/HMAC_Login/MySQL.php';

class _Test_HMAC_Login_MySQL extends _Test_HMAC_Login {

	function _Test_HMAC_Login_MySQL($name) {
        parent::__construct($name);
	}

	function setUp() {
		parent::setUp();
	}

	function tearDown() {
		parent::tearDown();
	}

	function &newObject() {
		$hmac_login = &new fbHMAC_Login_MySQL();
		return $hmac_login;
	}

}

# make PHPUnit_GUI_SetupDecorator() happy
class _HMAC_Login_Test_HMAC_Login_MySQL extends _Test_HMAC_Login_MySQL {
}

?>
<?php /*
	// \todo Implement test_checkaddress_1 in Test_HMAC_Login_MySQL.php
	function test_checkaddress_1() {
//		$o =& new MySQL();
//		$rv = $o->checkaddress();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_checkreferer_1 in Test_HMAC_Login_MySQL.php
	function test_checkreferer_1() {
//		$o =& new MySQL();
//		$rv = $o->checkreferer();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_checkuseragent_1 in Test_HMAC_Login_MySQL.php
	function test_checkuseragent_1() {
//		$o =& new MySQL();
//		$rv = $o->checkuseragent();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_close_1 in Test_HMAC_Login_MySQL.php
	function test_close_1() {
//		$o =& new MySQL();
//		$rv = $o->close();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_connect_1 in Test_HMAC_Login_MySQL.php
	function test_connect_1() {
//		$o =& new MySQL();
//		$rv = $o->connect();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_deletepercentage_1 in Test_HMAC_Login_MySQL.php
	function test_deletepercentage_1() {
//		$o =& new MySQL();
//		$rv = $o->deletepercentage();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_deleteunused_1 in Test_HMAC_Login_MySQL.php
	function test_deleteunused_1() {
//		$o =& new MySQL();
//		$rv = $o->deleteunused();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_deleteused_1 in Test_HMAC_Login_MySQL.php
	function test_deleteused_1() {
//		$o =& new MySQL();
//		$rv = $o->deleteused();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_getchallenge_1 in Test_HMAC_Login_MySQL.php
	function test_getchallenge_1() {
//		$o =& new MySQL();
//		$rv = $o->getchallenge();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_getlasterrno_1 in Test_HMAC_Login_MySQL.php
	function test_getlasterrno_1() {
//		$o =& new MySQL();
//		$rv = $o->getlasterrno();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_getlasterror_1 in Test_HMAC_Login_MySQL.php
	function test_getlasterror_1() {
//		$o =& new MySQL();
//		$rv = $o->getlasterror();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_getpassword_1 in Test_HMAC_Login_MySQL.php
	function test_getpassword_1() {
//		$o =& new MySQL();
//		$rv = $o->getpassword();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_setchallengetable_1 in Test_HMAC_Login_MySQL.php
	function test_setchallengetable_1() {
//		$o =& new MySQL();
//		$rv = $o->setchallengetable();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_setloginfield_1 in Test_HMAC_Login_MySQL.php
	function test_setloginfield_1() {
//		$o =& new MySQL();
//		$rv = $o->setloginfield();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_setlogintable_1 in Test_HMAC_Login_MySQL.php
	function test_setlogintable_1() {
//		$o =& new MySQL();
//		$rv = $o->setlogintable();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_setmaxattempts_1 in Test_HMAC_Login_MySQL.php
	function test_setmaxattempts_1() {
//		$o =& new MySQL();
//		$rv = $o->setmaxattempts();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_setpasswordfield_1 in Test_HMAC_Login_MySQL.php
	function test_setpasswordfield_1() {
//		$o =& new MySQL();
//		$rv = $o->setpasswordfield();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_settimeout_1 in Test_HMAC_Login_MySQL.php
	function test_settimeout_1() {
//		$o =& new MySQL();
//		$rv = $o->settimeout();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>
<?php /*
	// \todo Implement test_validate_1 in Test_HMAC_Login_MySQL.php
	function test_validate_1() {
//		$o =& new MySQL();
//		$rv = $o->validate();
//		$expected = 0;
//		$this->assertEquals($expected, $rv);
	}
*/ ?>

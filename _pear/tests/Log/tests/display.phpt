--TEST--
Log: Display Handler
--FILE--
<?php

require_once 'Log.php';

$conf = array('error_prepend' => '<tt>', 'error_append'  => '</tt>');
$logger = &Log::singleton('display', '', '', $conf);
for ($i = 0; $i < 3; $i++) {
	$logger->log("Log entry $i");
}

--EXPECT--
<tt><b>Info</b>: Log entry 0</tt><br />
<tt><b>Info</b>: Log entry 1</tt><br />
<tt><b>Info</b>: Log entry 2</tt><br />

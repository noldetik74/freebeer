#!/usr/bin/php
<?php

// $CVSHeader: _freebeer/bin/update_htaccess.php,v 1.1.1.1 2004/01/18 00:12:04 ross Exp $

// Copyright (c) 2001-2003, Ross Smith.  All rights reserved.
// Licensed under the BSD or LGPL License. See doc/license.txt for details.

error_reporting(2047);
@ini_set('html_errors', false);
@ini_set('track_errors', true);
@ob_implicit_flush(true);
@set_time_limit(0);

defined('FREEBEER_BASE') || define('FREEBEER_BASE', getenv('FREEBEER_BASE') ? getenv('FREEBEER_BASE') :
	dirname(dirname(__FILE__)));

require_once FREEBEER_BASE . '/lib/File.php'; // scandir

function update_htaccess($dir) {
	if (preg_match('|/opt/|', $dir)) {
			return true;
	}
	if (preg_match('|/wip/|', $dir)) {
			return true;
	}
	
	$files = fbFile::scandir($dir, 0, false);

	$dirs = array();
	$found = false;

	foreach($files as $file) {
		$path = $dir . '/' . $file;
		if (@is_dir($path)) {
				$dirs[] = $path;
				continue;
		}

		if ($file == '.htaccess') {
			$found = true;
			continue;
		}
	} // foreach($files as $file)

	$cvsheader_found = false;
	$deny_found = false;
	$lines = array();
	$path = $dir . '/.htaccess';	

	if ($found) {
		$lines = file($path);
		if ($lines === false) {
			die(sprintf("Can't open '%s': %s", $file, $php_errormsg));
		}
		for ($i = 0; $i < count($lines); ++$i) {
			if (preg_match('/deny\s+from\s+all/i', $lines[$i])) {
				$deny_found = true;
				break;
			}
			if (preg_match('/\$CVSHeader[^\$]*\$/', $lines[$i])) {
				$cvsheader_found = true;
				break;
			}
		}
		
	}

	if (!$deny_found || !$cvsheader_found) {
		if (!$deny_found) {
			$lines[] = "Deny from all\n";
		}
		if (!$cvsheader_found) {
			$lines[] = "\n# \$CVSHeader\$\n";
		}

		$file_tmp = $path . '.tmp';
		$file_bak = $path . '.bak';
		
		$fp = fopen($file_tmp, 'wb');
		if (!$fp) {
			die(sprintf("Can't create '%s': %s", $file_tmp, $php_errormsg));
		}
	
		for ($i = 0; $i < count($lines); ++$i) {
			fwrite($fp, $lines[$i]);
		}
		fclose($fp);
			
		printf("Updated %s\n", $path);
/*		
		if (!@rename($file, $file_bak)) {
			die(sprintf("Can't rename '%s' to '%s': %s", $file, $file_bak, $php_errormsg));
		}
		if (!@rename($file_tmp, $file)) {
			die(sprintf("Can't rename '%s' to '%s': %s", $file_tmp, $file, $php_errormsg));
		}
*/
	} // if (!$deny_found)
	
	foreach ($dirs as $dir) {
		if (!update_htaccess($dir)) {
			return false;
		}
	}
	
	return true;
} // function update_htaccess($dir)

update_htaccess(FREEBEER_BASE);

printf("Command completed successfully\n");

exit(0);

?>

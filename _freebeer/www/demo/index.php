<?php

// $CVSHeader: _freebeer/www/demo/index.php,v 1.1.1.1 2004/01/18 00:12:07 ross Exp $

// Copyright (c) 2001-2003, Ross Smith.  All rights reserved.
// Licensed under the BSD or LGPL License. See doc/license.txt for details.

require_once './_demo.php';

echo html_header_demo();

$dir = '/demo';
$dh = opendir(dirname(__FILE__)); // /todo fixme
$files = array();
while ($file = readdir($dh)) {
	if (!preg_match('/\.php$/', $file) ||
		preg_match('/^index\.php$/', $file) ||
		preg_match('/^_.*\.php$/', $file)) {
		continue;
	}
	$files[] = $file;
}
closedir($dh);

sort($files);

$body_text = '';

foreach ($files as $file) {
	$body_text .= sprintf("<a href=\"%s\">%s</a><br />\n", $dir . '/' . $file, $file);
}

echo $body_text;

?>
<address>
$CVSHeader: _freebeer/www/demo/index.php,v 1.1.1.1 2004/01/18 00:12:07 ross Exp $
</address>
</body>
</html>
#!/bin/sh

# $CVSHeader: _freebeer/bin/tidy1.sh,v 1.2 2004/03/07 17:51:14 ross Exp $

# Copyright (c) 2002-2004, Ross Smith.  All rights reserved.
# Licensed under the BSD or LGPL License. See license.txt for details.

if [ -z "$FREEBEER_BASE" ]; then
	FREEBEER_BASE=`dirname $0`
	if [ "$FREEBEER_BASE" = "." ]; then
		FREEBEER_BASE=`pwd`
	fi
	while [ ! -f "$FREEBEER_BASE/lib/System.php" ];
	do
		FREEBEER_BASE=`dirname $FREEBEER_BASE`
	done
fi

BAK=$1.bak
TMP=$1.tidy~

tidy -config $FREEBEER_BASE/etc/tidyrc $1 >$TMP
if [ $? -gt 0 ]; then
	exit $?
fi
if [ ! -s $TMP ]; then
	exit 1
fi

rm -f $BAK
mv -f $1 $BAK
mv -f $TMP $1

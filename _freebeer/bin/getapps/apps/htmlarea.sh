#!/bin/sh

# $CVSHeader: _freebeer/bin/getapps/apps/htmlarea.sh,v 1.1.1.1 2004/01/18 00:12:04 ross Exp $

# Copyright (c) 2001-2003, Ross Smith.  All rights reserved.
# Licensed under the BSD or LGPL License. See doc/license.txt for details.

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

NOW=`date +"%Y%m%d%H%M"`

if [ -z "$HTMLAREA_TAG" ]; then
#	HTMLAREA_TAG=table-devel
	HTMLAREA_TAG=HEAD
fi
CVS_TAG=$HTMLAREA_TAG
RTAG=${CVS_TAG}_$NOW

APP=htmlarea
DIR=$APP
CVS_ROOT=:pserver:anonymous@cvs.sourceforge.net:/cvsroot/itools-htmlarea
CVS_SUBDIR=

IMPORTDIR=
# DOCDIR=
# DOCFILES="*.cgi *.htm* *.txt"
RMFILES=

. $FREEBEER_BASE/bin/getapps/cvs.sh
#!/bin/bash

cat <<EOF
Package: sabaix86
Version: 1
Section: base
Priority: optional
Architecture: all
Depends: bash
Maintainer: david@sabaitechnology.com
Description: Sabai test package.
EOF
#chmod 775 x86/DEBIAN/{pre,post}{rm,inst}
#dpkg --build x86

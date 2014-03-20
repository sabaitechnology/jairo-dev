#!/bin/bash
_err(){ echo $1; exit 1; }

jainodeIP='127.0.2.2';
jainodePort='31400';
jaiUser="$(logname)";
jainodeRoot=$installRoot/node;
nodejs=$(which nodejs);
# [ "$(nodejs -e 'console.log("Test");')" == "Test" ]

echo $jainodeIP
echo $jainodePort
echo $jaiUser
echo $jainodeRoot
echo $nodejs

# [ -z $nodejs ] && _err "Please install node.js."
# [ ! -d /home/$user ] && _err "Please run as a user with a home directory.";
# [ $(id -u) -ne 0 ] && _err "Please run with sudo like this:\nsudo ./install.sh";
# [ ! -f /$jainodeRoot/jainode.js ] && _err "Jainode.js file is missing.";

# [ ! -d node_modules/socket.io ] && sudo -u $jaiUser npm install socket.io;
# cp node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.min.js ../jai/libs/

# cat  >/etc/init/jainode.conf <<JAINODECONF
# description "node.js testing jainode service"
# author "david@sabaitechnology.com"

# start on runlevel [2345]
# stop on runlevel [!2345]

# respawn
# respawn limit 10 5

# script
# 	export HOME="/home/$jaiUser"
# 	exec sudo -u $jaiUser $nodejs $jainodeRoot/jainode.js >> /var/log/jainode.log 2>&1
# end script
# JAINODECONF
# grep -q jainode /etc/hosts || sed -i "/$(grep "^127" /etc/hosts | tail -n1)/ a$jainodeIP\tjainode" /etc/hosts

# service jainode restart

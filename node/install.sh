#!/bin/bash
_err(){ echo $1; exit 1; }

ip='127.0.2.2';
port='31400';
user="$(logname)";
installDirectory="$(dirname `readlink -f $0`)"

[ ! -d /home/$user ] && _err "Please run as a user with a home directory";
[ $(id -u) -ne 0 ] && _err "Please run with sudo like this:\nsudo ./install.sh";
[ ! -f /$installDirectory/jainode.js ] && _err "Jainode.js file is missing.";

[ ! -d node_modules/socket.io ] && sudo -u $user npm install socket.io;
cp node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.min.js ../jai/libs/

cat  >/etc/init/jainode.conf <<JAINODECONF
description "node.js testing jainode service"
author "david@sabaitechnology.com"

start on runlevel [2345]
stop on runlevel [!2345]

respawn
respawn limit 10 5

script
	export HOME="/home/$user"
	exec sudo -u $user /usr/local/bin/node $installDirectory/jainode.js >> /var/log/jainode.log 2>&1
end script
JAINODECONF
grep -q jainode /etc/hosts || sed -i "/$(grep "^127" /etc/hosts | tail -n1)/ a$ip\tjainode" /etc/hosts

service jainode restart

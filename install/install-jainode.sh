#!/bin/bash
_err(){ echo $1; exit 1; }

jainode_ip='127.0.2.2';
#jainode_port='31400'; #currently unused
jainode_user="$(logname)";
jainode_root=$jai_installRoot/node;
jainode_nodejs=$(which nodejs);
# [ "$(nodejs -e 'console.log("Test");')" == "Test" ]

echo $jainodeIP
echo $jaiUser
echo $jainodeRoot
echo $nodejs

# [ -z $jainode_nodejs ] && _err "Please install node.js."
# [ ! -d /home/$jainode_user ] && _err "Please run as a user with a home directory.";
# [ $(id -u) -ne 0 ] && _err "Please run with sudo like this:\nsudo ./install.sh";
# [ ! -f /$jainode_root/jainode.js ] && _err "Jainode.js file is missing.";

# [ ! -d node_modules/socket.io ] && sudo -u $jainode_user npm install socket.io;
# cp node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.min.js ../jai/libs/

# cat  >/etc/init/jainode.conf <<JAINODECONF
# description "node.js testing jainode service"
# author "david@sabaitechnology.com"

# start on runlevel [2345]
# stop on runlevel [!2345]

# respawn
# respawn limit 10 5

# script
# 	export HOME="/home/$jainode_user"
# 	exec sudo -u $jainode_user $jainode_nodejs $jainode_root/jainode.js >> /var/log/jainode.log 2>&1
# end script
# JAINODECONF
# grep -q jainode /etc/hosts || sed -i "/$(grep "^127" /etc/hosts | tail -n1)/ a$jainode_ip\tjainode" /etc/hosts

# service jainode restart

#!/bin/bash
_err(){ echo $1; exit 1; }

jai_ro_ip='127.0.2.2';
#jai_ro_port='31400'; #currently unused
jai_ro_user="$(logname)";
jai_ro_root=$jai_installRoot/node;
jai_ro_nodejs=$(which nodejs);
# [ "$(nodejs -e 'console.log("Test");')" == "Test" ]

# We assume development because
development=${development:=true}

if $development; then
	echo "Dev install."
	# jai_ro_listenat=1;
	# while (grep -q "^127.0.2.$jai_ro_listenat" /etc/hosts); do
	# 	jai_ro_listenat=$(( jai_ro_listenat + 1 ));
	# done
	# jai_ro_ip="127.0.2.$jai_ro_listenat"
else
	echo "Regular install."
	# echo "Assuming localhost";
fi
# for i in {1..254}; do
# 	grep -q "127.0.2.$i" /etc/hosts || (echo $i && ); done

# echo $jai_ro_ip
# echo $jaiUser
# echo $jai_ro_root
# echo $nodejs

# [ -z $jai_ro_nodejs ] && _err "Please install node.js."
# [ ! -d /home/$jai_ro_user ] && _err "Please run as a user with a home directory.";
# [ $(id -u) -ne 0 ] && _err "Please run with sudo like this:\nsudo ./install.sh";
# [ ! -f /$jai_ro_root/jainode.js ] && _err "Jainode.js file is missing.";

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

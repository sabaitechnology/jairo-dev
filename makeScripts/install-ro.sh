#!/bin/bash
_err(){ echo $1; exit 1; }

ro_ip='127.0.2.2';
#ro_port='31400'; #currently unused
ro_user="$(logname)";
ro_root=$jai_installRoot/node;
ro_nodejs=$(which nodejs);
# [ "$(nodejs -e 'console.log("Test");')" == "Test" ]

# We assume development
development=${development:=true}

if $development; then
	# ro_listenat=1;
	# while (grep -q "^127.0.2.$ro_listenat" /etc/hosts); do
	# 	ro_listenat=$(( ro_listenat + 1 ));
	# done
	# ro_ip="127.0.2.$ro_listenat"
else
	echo "Regular install."
	# echo "Assuming localhost";
fi
# for i in {1..254}; do
# 	grep -q "127.0.2.$i" /etc/hosts || (echo $i && ); done

# echo $ro_ip
# echo $jaiUser
# echo $ro_root
# echo $nodejs

# [ -z $ro_nodejs ] && _err "Please install node.js."
# [ ! -d /home/$ro_user ] && _err "Please run as a user with a home directory.";
# [ $(id -u) -ne 0 ] && _err "Please run with sudo like this:\nsudo ./install.sh";
# [ ! -f /$ro_root/jainode.js ] && _err "Jainode.js file is missing.";

# [ ! -d node_modules/socket.io ] && sudo -u $jainode_user npm install socket.io;
# cp node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.min.js ../jai/libs/

# cat  >/etc/init/jainode.conf <<ROCONF
# description "JaiRo node.js backend component service"
# author "david@sabaitechnology.com"

# start on runlevel [2345]
# stop on runlevel [!2345]

# respawn
# respawn limit 10 5

# script
# 	export HOME="/home/$ro_user"
# 	exec sudo -u $ro_user $ro_nodejs $ro_root/ro.js >> /var/log/ro.log 2>&1
# end script
# ROCONF

# grep -q jainode /etc/hosts || sed -i "/$(grep "^127" /etc/hosts | tail -n1)/ a$jainode_ip\tjainode" /etc/hosts

# service ro restart

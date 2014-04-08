#!/bin/bash
_err(){ echo $1; exit 1; }

ro_ip=${ro_ip:="127.0.2.1"}
#ro_port='31400'; #currently unused
ro_user=$jai_user;
ro_root=$jai_installRoot/ro;
ro_nodejs=$(which nodejs);
# [ "$(nodejs -e 'console.log("Test");')" == "Test" ] ### Possible node sanity check?

# We assume development
development=${development:=true}

if $development; then
	ro_ip=$(./find-unused-local-ip.sh $ro_ip);
	ro_hostname="localjai"
	ro_ports=(31400 31401 31402 31403)
else
	ro_ip=127.0.0.1
	ro_hostname="localhost"
	ro_ports=($(./find-unused-ports.sh $ro_ip));
fi

#echo "IP & Ports: $ro_ip / (${#ro_ports[*]}) ${ro_ports[@]}" >&2
# echo $jaiUser
# echo $ro_root
# echo $nodejs

# [ -z $ro_nodejs ] && _err "Please install node.js."
# [ ! -d /home/$ro_user ] && _err "Please run as a user with a home directory.";
# [ $(id -u) -ne 0 ] && _err "Please run with sudo like this:\nsudo ./install.sh";
# [ ! -f /$ro_root/ro.js ] && _err "ro.js file is missing.";

# if [ ! -d $ro_root/node_modules/socket.io ]; then
#	cd $ro_root && sudo -u $ro_user npm install socket.io;
# cp $ro_root/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.min.js $ro_root/jai/libs/

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

# grep -q $ro_hostname /etc/hosts || sed -i "/$(grep "^127" /etc/hosts | tail -n1)/ a$ro_ip\tro_hostname" /etc/hosts

# service ro restart

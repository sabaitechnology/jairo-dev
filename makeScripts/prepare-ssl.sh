#!/bin/bash
_err(){ echo $1; exit 1; }

_sudoInstall(){
	### install new host file, Upstart symlink, then start service
	[ -d conf ] || _err "Cannot install without conf files.";
	grep -q localsec conf/hosts.bak || sudo sed -i "/$(grep "^127" /etc/hosts | tail -n1)/ a$(cat conf/ip)\tlocalsec" /etc/hosts
	cp conf/localsec.conf /etc/apache2/sites-available/
	a2enmod ssl
	a2ensite localsec
	service apache2 reload
	([ -L /etc/init/sec.js.conf ] && [ "$(readlink /etc/init/sec.js.conf)" != "$installDirectory/conf/sec.js.conf" ]) && _err "Service Symlink exists but points elsewhere." || ln -s conf/sec.js.conf /etc/init/
	service sec.js restart
}

_sudoRemove(){
	sudo sed -i "/localsec/d" /etc/hosts
	sudo a2dissite localsec
	sudo service apache2 reload
	sudo service sec.js stop
	sudo rm /etc/apache2/sites-available/localsec.conf
	([ -L /etc/init/sec.js.conf ] && [ "$(readlink /etc/init/sec.js.conf)" == "$installDirectory/conf/sec.js.conf" ]) && sudo rm /etc/init/sec.js.conf || _err "Service Symlink exists but points elsewhere, so not removed."
}

_prepare(){
	ip=2;
	port=31415;
	user=$(whoami);
	defaultSubject="/C=US/ST=SC/L=Simpsonville/O=Sabai Technology/OU=Development/CN=localsec/emailAddress=$user@localsec";

	[ -z "$user" ] || _err "Who ARE you?"
	[ "$user" == root ] && _err "Cannot install as root";

	### Find the repo folder
	installDirectory="$(dirname `readlink -f $0`)"
	echo 

	###		Find an available local address in the 127.0.0.0/8 subnet
	while [ -n "$(grep \"^127.0.0.$ip\" /etc/hosts)" ] && [ $(( ip++ )) -lt 255 ]; do :; done;
	[ $ip -lt 255 ] || _err "Could not find ip in normal range.";
	ip="127.0.0.$ip";
	echo -n "$ip" > conf/ip

	###		Find an unused port for the service
	while lsof -Pni 4tcp@0.0.0.0:$port && [ $(( port++ )) -lt 32768 ]; do :; done;
	[ $port -lt 32767 ] || _err "Could not find port in normal range.";
	echo "$ip:$port";

	mkdir -p conf

	###		Add a hostname for the ip and rewrite the node program to use the open port on that host.
	cp /etc/hosts conf/hosts.bak
	sed "s|~PORT~|$port|g" src/sec.js.SRC > node/sec.js;
	sed "s|~installDirectory~|$installDirectory|g" src/localsec.conf.SRC > conf/localsec.conf

	###		Set up a private key and browser certificate
	openssl req -x509 -nodes -days 3650 -newkey rsa:2048 -keyout conf/key -out conf/crt -subj "$defaultSubject" 2>/dev/null
	echo -en "{\n\t\"crt\": \"$(sed 's/$/\\n/g' conf/crt | tr -d '\n')\",\n\t\"key\": \"$(sed 's/$/\\n/g' conf/key | tr -d '\n')\"\n}\n" > node/ssl.json

	###		Generate Upstart config
	sed "s|~USER~|$user|g" src/sec.js.conf.SRC > conf/sec.js.conf;
}

_clean(){ rm -r conf node/ssl.json node/sec.js; }
_install(){ _prepare; install; }
_remove(){ sudo $0 sudoRemove; }

case "$1" in
	prepare)		_prepare		;;
	sudoInstall)	_sudoInstall	;;
	install)		_install		;;
	sudoRemove)		_sudoRemove		;;
	remove)			_remove			;;
esac
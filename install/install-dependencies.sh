#!/bin/bash

ppas="\
ppa:ondrej/php5 \
chris-lea/node.js";

dependencies="\
nodejs apache2 tree \
pptpd pptp-linux openvpn ipset
php5 php5-mysqlnd php5-json mcrypt php5-mcrypt libmcrypt-dev \
samba smbclient smbfs cifs-utils sshfs \
bind9 isc-dhcp-server isc-dhcp-client squid3 \
mysql-client mysql-server \
postfix mailutils";

dependencyselections=(\
"mysql-server mysql-server/root_password password 'heart router sabai home" \
"mysql-server mysql-server/root_password_again password 'heart router sabai home'" \
"postfix postfix/mailname string jai" \
"postfix postfix/main_mailer_type string 'Internet Site'");

apt-get update
apt-get install -y software-properties-common python-software-properties
for ppa in $ppas; do
	add-apt-repository -y "$ppa";
done
apt-get update

for dependency in "${dependencyselections[@]}"; do
	echo "$dependency" | debconf-set-selections;
done
apt-get install -y $dependencies
apt-get update
apt-get upgrade -y

#	# [ $(apt-get -s upgrade | grep -c Inst) -gt 0 ] ### Dumb way of checking if there are any further upgrades, but it works.

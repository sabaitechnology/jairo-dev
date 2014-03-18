



BASH := $(shell which bash)
ifdef BASH
	SHELL = $(BASH)
endif

ppa-list = ppa:ondrej/php5 chris-lea/node.js


dependency-list =  nodejs apache2 tree
dependency-list += pptpd pptp-linux openvpn ipset
dependency-list += php5 php5-mysqlnd php5-json mcrypt php5-mcrypt libmcrypt-dev 
dependency-list += mysql-client mysql-server
dependency-list += samba smbclient smbfs cifs-utils sshfs
dependency-list += bind9 isc-dhcp-server isc-dhcp-client squid3
# dependency-list += postfix mailutils
# debconf-set-selections <<< "postfix postfix/mailname string jai"
# debconf-set-selections <<< "postfix postfix/main_mailer_type string 'Internet Site'"

# update: $(shell find jai -type f) $(shell find configuration -type f)

# built/jairo.deb: update
# 	dpkg-deb --build ./debian built/jairo.deb

# debian: built/jairo.deb

dependencies:
	# MAKE $@
	# $(SHELL) / $(BASH)
	# sudo apt-get update
	# sudo apt-get install software-properties-common python-software-properties
	# sudo add-apt-repository
#	# [ $(apt-get -s upgrade | grep -c Inst) -gt 0 ] ### Dumb way of checking if there are any further upgrades, but it works.

dev-install: dependencies
	# MAKE $@
#	$(shell sudo apt-get update && sudo apt-get install software-properties-common

.PHONY : clean debian

clean:
#	@rm built/*

# demo:
# 	@rm -rf demo
# 	cp -r jai demo
# 	rm demo/apps
# 	cp -r apps demo/
# 	rm -rf demo/apps/basicNetwork/php
# 	mv demo/apps/basicNetwork/demo demo/apps/basicNetwork/php

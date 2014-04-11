#!/bin/bash

hostsFile=/etc/hosts

if [ -z "$1" ]; then
	dot=(127 0 2 1);
else
	OIFS=$IFS
	IFS=.
	dot=($1)
	IFS=$OIFS
fi

incrementIP(){
	(( dot[3]++ ))
	if [ ${dot[3]} -gt 254 ]; then
		dot[3]=1;
		(( dot[2]++ ))
		if [ ${dot[2]} -gt 254 ]; then
			dot[2]=0;
			(( dot[1]++ ))
			if [ ${dot[1]} -gt 254 ]; then
				echo "Exceeded ipv4 limits."
				exit 1;
			fi
		fi
	fi	
	dip=$(IFS=.; echo "${dot[*]}")
}

ipInHosts(){ grep -q "^$dip" $hostsFile; }

ipInUse(){ lsof -ni4tcp@$dip; }

dip=$(IFS=.; echo "${dot[*]}");

while (ipInHosts || ipInUse); do
	incrementIP;
done

echo $dip;

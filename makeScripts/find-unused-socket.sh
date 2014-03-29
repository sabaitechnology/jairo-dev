#!/bin/bash

hostsFile=/etc/hosts

if [ -z "$1" ]; then
	dot=(127 0 0 2);
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
}

isInHosts(){
	if (grep -q "^$dip" $hostsFile); then
		inHosts=false
	else
		inHosts=true
	fi
}

isInUse(){
	lsof
}


# dip=$(IFS=.; echo "${dot[*]}")
# dip=$(IFS=.; echo "${dot[*]}")

inHosts=true;
inUse=true;



# echo "Start: $dip";

# while ($inHosts || $inUse); do
# 	incrementIP;
# 	isInHosts;
# 	isInUse;
# done

# ( IFS=.; echo "Found: ${dot[*]}" )

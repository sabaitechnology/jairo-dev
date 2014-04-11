#!/bin/bash

localIP=${1:-"127.0.0.1"}
startPort=${2:-31400}
portCount=${3:-4}
[ $portCount -gt 10 ] && portCount=10;

# echo -e "localIP: $localIP\nstartPort: $startPort\nportCount: $portCount" 1>&2

portInUse(){
	### This is testing code and can probably be discarded.
	# case "$1" in
	# 	31400|31401|31403|31404|31407|31409)
	# 		return 0;
	# 		;;
	# 	*)
	# 		return 1;
	# 		;;
	# esac
	lsof -ni4@$localIP:$1;
}

ports=()

while [ ${#ports[@]} -lt $portCount ]; do
	while portInUse $startPort; do
		(( startPort++ ))
	done
	ports[${#ports[*]}]=$(( startPort++ ));
done

echo "${ports[*]}"

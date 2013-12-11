#!/bin/bash

_msg(){ echo "{ \"sabai\": $1, \"msg\": \"$2\" }"; exit 0; }
_err(){ _msg 'false' "$1"; }

_ip=$1
[ -z $ip ] && _err "No IP was supplied."

_mask=$2
_lease=$3
_nadd=$4
_badd=$5
_low=$6
_up=$7
_on=$8

dhcpconf="/etc/dhcp/dhcpd.conf"
ifconf="/etc/network/interfaces"

exit 0;

#  -i is for replacing data in the input file
# s/OLD/NEW/ part performs a substitution
sed -i -e "/address .*/ s/ .*/ $1/" $ifconf
sed -i -e "/network .*/ s/ .*/ $4/" $ifconf
sed -i -e "/netmask .*/ s/ .*/ $2/" $ifconf
sed -i -e "/broadcast .*/ s/ .*/ $5/" $ifconf


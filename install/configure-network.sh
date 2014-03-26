#!/bin/bash

cat <<DHCPDCONF
ddns-update-style none;

authoritative;

# Use this to send dhcp log messages to a different log file (you also have to hack syslog.conf to complete the redirection).
#log-facility local7;

subnet 10.0.0.0 netmask 255.255.255.0 {
	range 10.0.0.2 10.0.0.254;
	option routers 10.0.0.1;
	option domain-name-servers 4.2.2.2, 8.8.8.8, 208.67.222.222;
	option domain-name "sabai";
	default-lease-time 86400;
	max-lease-time 864000;
}
DHCPDCONF;

cat <<NETWORK_INTERFACES
# This file describes the network interfaces available on your system
# and how to activate them. For more information, see interfaces(5).

# The loopback network interface
auto lo
iface lo inet loopback

# The primary network interface
auto eth0
iface eth0 inet dhcp

iface wlan0 inet manual
	hostapd /etc/hostapd/hostapd.conf
# pre-up killall hostapd || true
# up hostapd -B /etc/hostapd/hostapd.conf
# post-down killall hostapd || true

auto br0
iface br0 inet static
	bridge_ports regex eth[1-9] #wlan0
	bridge_maxwait 0
	address 10.0.0.1
	network 10.0.0.0
	netmask 255.255.255.0
	broadcast 10.0.0.255
#	pre-up killall dhcpd 2>/dev/null || true
#	pre-up killall hostapd 2>/dev/null || true
#	pre-up ifup wlan0
#	post-up dhcpd br0
	post-up ifup wlan0
#	post-up hostapd -B /etc/hostapd/hostapd.conf
#	post-down killall hostapd 2>/dev/null || true
	pre-down ifdown wlan0
#	pre-down killall dhcpd 2>/dev/null || true
NETWORK_INTERFACES;


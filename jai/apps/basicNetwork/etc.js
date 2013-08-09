{
 "sys": {
  "wuid": "CADEIC"
 },
 "wan": {
  "if": "eth0",
  "type": "dhcp",
  "ip": false,
  "mask": false,
  "gateway": false,
  "mtu": 1440,
  "mac": "00:07:32:23:0f:25"
 },
 "dns": {
  "servers": ["4.2.2.2","8.8.8.8","208.67.222.222","208.67.220.220"]
 },
 "lan": {
  "if": "br0",
  "ifs": ["eth1","eth2","eth3","eth4","eth5"],
  "ip": "10.0.0.1",
  "mask": "255.255.255.0"
 },
 "ntp": {
  "servers": ["0.pool.ntp.org","1.pool.ntp.org","2.pool.ntp.org","ntp.sabaitechnology.com"],
  "zone": "America/New_York",
  "lower": 6,
  "upper": 10,
  "serve": false
 },
 "dhcp": {
  "on": true,
  "lower": "10.0.0.100",
  "upper": "10.0.0.199",
  "lease": 86400
 },
 "wl": [
  {
   "type": "server",
   "security": "wpapersonal",
   "wpa": {
    "type": 3,
    "encryption": 3
   }
  }
 ]
}

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
  "mtu": 1500,
  "mac": "00:07:32:23:0f:25"
 },
 "dns": {
  "servers": ["4.2.2.2","8.8.8.8","208.67.222.222","208.67.220.220","1.1.1.1"]
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
  "on": false,
  "lower": "10.0.0.100",
  "upper": "10.0.0.199",
  "lease": 86400
 },
 "wl": [
  {
   "type": "server",
   "ssid": "JaiRo",
   "security": "wpapersonal",
   "wpa": {
    "type": 3,
    "encryption": 3,
    "psk": "sabaijai321",
    "rekey": 3600
   },
   "wep": {
    "keys": ["webKeyOne","webKeyTwo","webKeyThree","webKeyFour"]
   },
   "macfilter": {
    "policy": "Allow",
    "allow":[],
    "deny":[]
   }
  }
 ],
 "vpn": {
  "pptp": {
   "server": "pptpvpn.sabaitechnology.com",
   "username": "sabai",
   "password": "sabaipass"
  },
  "l2tp": {
   "realname": "Default",
   "server": "pptpvpn.sabaitechnology.com",
   "username": "sabai",
   "password": "sabaipass",
   "psk": "1234567890"
  },
  "openvpn": {}
 },
 "ping": {
  "address" : "10.0.134.90",
  "count" : 3,
  "size" : 56
 },
 "trace" : {
  "address" : "10.0.134.90",
  "hops" : 20,
  "wait" : 3
 },
 "nslookup" : {
  "domain" : "www.google.com"
 },
 "gateways": {
  "default": "vpn",
  "rules": [
   { "mac": "000000000001", "ip": 101, "gateway": 1 },
   { "mac": "000000000002", "ip": 102, "gateway": 2 },
   { "mac": "000000000003", "ip": 103, "gateway": 1 }

  ]
 },
 "upnp" : {
  "internalLB" : 2,
  "internalUB" : 65535,
  "externalLB" : 1024,
  "externalUB" : 2000 
 },
 "firewall" : {
  "icmp" : "checked",
  "multicast": "checked",
  "cookies": "checked",
  "wan" : ""
 },
 "dmz" : {
  "destination": "192.168.199.0"
},
"conntrack" : {
    "maxConnection" : 8192,
    "hashTableSize" : 2048,
    "established" : 1800,
    "synSent" : 30,
    "synReceived" : 20,
    "finWait" : 20,
    "timeWait" : 20,
    "close" : 10,
    "closeWait" : 20,
    "lastAck" : 20,
    "unreplied" : 30,
    "assured" : 180,
    "generic" : 10,
    "icmp" : 10,
    "ftp" : "checked",
    "gre" : "checked",
    "h" : "checked",
    "sip" : "checked",
    "rtsp" : "",
    "ttlAdjust" : "None",
    "inboundLayer" : "checked"
},


 "portforward": [
  { "on": true, "protocol": 1, "route": 1, "src": "24.240.173.193/8", "external": 22, "internal": 22, "device": "10.0.0.2", "description": "What?" },
  { "on": true, "protocol": 1, "route": 2, "src": "24.240.173.193/8", "external": 23, "internal": 23, "device": "10.0.0.2", "description": "What?" },
  { "on": true, "protocol": 3, "route": 1, "src": "24.240.173.193/8", "external": 24, "internal": 24, "device": "10.0.0.2", "description": "What?" }
 ]

}

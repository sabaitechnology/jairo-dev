#!/bin/bash

ip=2;
port=31415;
user=$(whoami);
defaultSubject="/C=US/ST=SC/L=Simpsonville/O=Sabai Technology/OU=Development/CN=localsec/emailAddress=$user@localsec";

[ -z "$user" ] || _err "Who ARE you?"
[ "$user" == root ] && _err "Cannot install as root";

###		Set up a private key and browser certificate
openssl req -x509 -nodes -days 3650 -newkey rsa:2048 -keyout conf/key -out conf/crt -subj "$defaultSubject" 2>/dev/null
echo -en "{\n\t\"crt\": \"$(sed 's/$/\\n/g' conf/crt | tr -d '\n')\",\n\t\"key\": \"$(sed 's/$/\\n/g' conf/key | tr -d '\n')\"\n}\n" > node/ssl.json


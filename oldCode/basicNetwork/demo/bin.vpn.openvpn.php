<?php 

 header('Content-type: text/ecmascript'); 

$dl = <<<EOF
{
    "openvpn": [
        {
            "server": "123.45.6.7",
            "user": "jaiRo",
            "password": "sabaiii",
            "name": "Simpsonville",
            "secret": "technology",
            "certs" : "accelerouter"
        },
        {
            "server": "98.7.65.43",
            "user": "tswift",
            "password": "gettingback2gether",
            "name": "Nashville",
            "secret": "goatversion",
            "certs" : "never"
        },
        {
            "server": "246.8.1.0",
            "user": "fruitloops",
            "password": "banana",
            "name": "Farmville",
            "secret": "apple",
            "certs" : "orange"
        }
    ]
}


EOF
;

echo $dl;
 ?>
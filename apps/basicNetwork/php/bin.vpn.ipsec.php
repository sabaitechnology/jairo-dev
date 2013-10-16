<?php 

 header('Content-type: text/ecmascript'); 

$dl = <<<EOF
{
    "ipsec": [
        {
            "server": "203.54.1.20",
            "user": "chinacat",
            "password": "meowmeow",
            "name": "",
            "secret": "siamese",
            "certs" : ""
        },
        {
            "server": "42.2.2.2",
            "user": "topofspaghetti",
            "password": "meatball",
            "name": "New York",
            "secret": "parmesan",
            "certs" : ""
        },
        {
            "server": "200.50.2.7",
            "user": "noyousir",
            "password": "password",
            "name": "Tokyo",
            "secret": "victoria",
            "certs" : ""
        }
    ]
}


EOF
;

echo $dl;
 ?>
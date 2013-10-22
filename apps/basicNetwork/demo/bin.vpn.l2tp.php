<?php 

 header('Content-type: text/ecmascript'); 

$l2tp = array(
 'server'=>"/^\s*\"server\": \"(.*)\"/",
 'user'=>"/^\s*\"user\": \"(.*)\"/",
 'password'=>"/^\s*\"password\": \"(.*)\"/",
 'name'=>"/^\s*\"name\": \"(.*)\"/"
);

$dl = <<<EOF
{
    "l2tp": [
        {
            "server": "192.32.1.20",
            "user": "L2-D2",
            "password": "c3p0droid",
            "name": "Naboo",
            "secret": "lukeskywalker"
        },
        {
            "server": "76.2.17.2",
            "user": "marathonjane",
            "password": "26.2miles",
            "name": "Boulder",
            "secret": "luv2run"
        },
        {
            "server": "230.80.2.11",
            "user": "codehackr",
            "password": "scrambledeggs",
            "name": "Silicon Valley",
            "secret": "sneaker"
        }
    ]
}


EOF
;

echo $dl;
 ?>
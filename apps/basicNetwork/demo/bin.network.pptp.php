<?php 

 header('Content-type: text/ecmascript'); 

$pptp = array(
 'server'=>"/^\s*\"server\": \"(.*)\"/",
 'user'=>"/^\s*\"user\": \"(.*)\"/",
 'password'=>"/^\s*\"password\": \"(.*)\"/",
 'name'=>"/^\s*\"name\": \"(.*)\"/"
);

$dl = <<<EOF
{
    "pptp": [
        {
            "server": "203.54.1.20",
            "user": "chinacat",
            "password": "meowmeow",
            "name": ""
        },
        {
            "server": "42.2.2.2",
            "user": "topofspaghetti",
            "password": "meatball",
            "name": "New York"
        },
        {
            "server": "200.50.2.7",
            "user": "noyousir",
            "password": "password",
            "name": "Tokyo"
        }
    ]
}


EOF
;

//find length of pptp array
//loop through array
//make a new control box, CBtitle span, CBcontent div, and hidden details div for each pptp
echo $dl;
 ?>
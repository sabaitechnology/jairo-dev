<?php 

 header('Content-type: text/ecmascript'); 

$dl = <<<EOF
{
    "ipsec": [
        {
            "server": "135.79.1.35",
            "user": "santaclaws",
            "password": "kringlekat",
            "name": "North Pole",
            "secret": "presents",
            "certs" : "reindeerelves"
        },
        {
            "server": "222.22.2.2",
            "user": "boringbob",
            "password": "password",
            "name": "Montana",
            "secret": "none",
            "certs" : "yawnyawn"
        },
        {
            "server": "192.83.74.65",
            "user": "weatherman",
            "password": "sunshine",
            "name": "Home",
            "secret": "clouds",
            "certs" : "hailstorm"
        }
    ]
}


EOF
;

echo $dl;
 ?>
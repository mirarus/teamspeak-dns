<?php

// composer require mirarus/teamspeak-dns

require "vendor/autoload.php";

use Mirarus\TeamSpeakDNS\Authorization;
use Mirarus\TeamSpeakDNS\Dns;
use Mirarus\TeamSpeakDNS\Register;
/*
$register = new Register();
print_r($register->register("infoaligucludev", "info@aliguclu.dev", "infoaligucludev"));
print_r($register->activate("info@aliguclu.dev", "mirarustrx"));
*/


$authorization = new Authorization("--myteamspeak.com--email--", "--myteamspeak.com-password--");

print_r($authorization->login()); // >>> user Data

$dns = new Dns($authorization);

print_r($dns->list());
/*
@usage $dns->list()
@result: stdClass Object
(
    [items] => Array
        (
            [0] => stdClass Object
                (
                    [id] => mirarus
                    [name] => mirarus
                    [host] => 127.0.0.1
                    [port] => 9987
                )
        )
    [count] => 1
)
*/

// [id] => mirarus >>> id >>> update|delete first element
print_r($dns->create("mirarus", '127.0.0.1', 9987)); // status => true | false
print_r($dns->update("mirarus", "mirarusx", '127.0.0.1', 9900)); // status => true | false
print_r($dns->delete("mirarus")); // status => true | false
<?php

// composer require mirarus/teamspeak-dns

require "vendor/autoload.php";

use Mirarus\TeamSpeakDNS\Authorization;
use Mirarus\TeamSpeakDNS\Dns;

$authorization = new Authorization("--email--", "--password--");

print_r($authorization->login()); // >>> user Data
 

$dns = new Dns($authorization);

print_r($dns->list());
/*
@usage $dns->list()

@result stdClass Object
(
    [items] => Array
        (
            [0] => stdClass Object
                (
                    [resources] => stdClass Object
                        (
                            [self] => stdClass Object
                                (
                                    [uri] => /servers/ZHNzc2Rhc2Rk
                                    [methods] => Array
                                        (
                                            [0] => DELETE
                                            [1] => PUT
                                        )

                                )

                        )

                    [entityType] => NAMED_SERVER_RESOURCE
                    [data] => stdClass Object
                        (
                            [nick] => dsssdasdd
                            [target] => stdClass Object
                                (
                                    [type] => IP
                                    [ipv4] => stdClass Object
                                        (
                                            [host] => 127.0.0.1
                                            [port] => 9900
                                        )

                                )

                        )

                )

        )

    [count] => 1
)
*/

// [uri] => /servers/ZHNzc2Rhc2Rk  >>> sid >>> update|delete first element

print_r($dns->update("ZHNzc2Rhc2Rk", "dsssdasdd", '127.0.0.1', 9900)); // status => true | false
print_r($dns->delete("ZHNzc2Rhc2Rk")); // status => true | false

print_r($dns->create("dsssdasdd", '127.0.0.1', port: 9987)); // status => true | false
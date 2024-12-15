<?php

namespace Mirarus\TeamSpeakDNS;

class Hash
{
    public static function ts3Login($p, $N)
    {
        $L = strtolower($N) . "ts3Login" . $p;
        $hash = hash_pbkdf2("sha512", $p, $L, 10000, 48, true);
        return base64_encode($hash);
    }
}

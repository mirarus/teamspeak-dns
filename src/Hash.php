<?php

namespace Mirarus\TeamSpeakDNS;

class Hash
{
	/**
	 * @param $email
	 * @param $password
	 * @return string
	 */
	public static function ts3Login($email, $password): string
    {
	    $salt = strtolower($email) . "ts3Login" . $password;
        $hash = hash_pbkdf2("sha512", $password, $salt, 10000, 48, true);
        return base64_encode($hash);
    }
}

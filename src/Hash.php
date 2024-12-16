<?php

namespace Mirarus\TeamSpeakDNS;

/**
 * Hash
 *
 * @package    Mirarus\TeamSpeakDNS
 * @author     Ali Güçlü <aliguclutr@gmail.com>
 * @copyright  Copyright (c) 2024
 * @license    MIT
 * @version    1.0.1
 * @since      1.0.0
 */
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

	/**
	 * @param $email
	 * @param $password
	 * @return string
	 */
	public static function ts3Encryption($email, $password): string
	{
		$salt = $email . "ts3Encryption" . $password;
		$hash = hash_pbkdf2("sha512", $password, $salt, 10000, 32, true);
		return base64_encode($hash);
	}
}

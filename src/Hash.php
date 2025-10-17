<?php

namespace Mirarus\TeamSpeakDNS;

/**
 * Hash
 *
 * @package    Mirarus\TeamSpeakDNS
 * @author     Ali Güçlü <aliguclutr@gmail.com>
 * @copyright  Copyright (c) 2025
 * @license    MIT
 * @version    1.0.2
 * @since      1.0.0
 */
class Hash
{
	/**
	 * @param  string  $email
	 * @param  string  $password
	 * @return string
	 */
	public static function ts3Login(string $email, string $password): string
	{
		$salt = strtolower($email)."ts3Login".$password;
		$hash = hash_pbkdf2("sha512", $password, $salt, 10000, 48, true);
		return base64_encode($hash);
	}
	
	/**
	 * @param  string  $email
	 * @param  string  $password
	 * @return string
	 */
	public static function ts3Encryption(string $email, string $password): string
	{
		$salt = $email."ts3Encryption".$password;
		$hash = hash_pbkdf2("sha512", $password, $salt, 10000, 32, true);
		return base64_encode($hash);
	}
}

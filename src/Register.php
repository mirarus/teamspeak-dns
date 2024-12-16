<?php

namespace Mirarus\TeamSpeakDNS;

use stdClass;

/**
 * Register
 *
 * @package    Mirarus\TeamSpeakDNS
 * @author     Ali Güçlü <aliguclutr@gmail.com>
 * @copyright  Copyright (c) 2024
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 */
class Register
{
	private $request;

	public function __construct()
	{
		$this->request = new Request();
	}

	/**
	 * @param $username
	 * @param $email
	 * @param $password
	 * @return mixed|stdClass|string
	 */
	public function register($username, $email, $password)
	{
		$hashedPassword = Hash::ts3Login($email, $password);

		return $this->request->post('register', [
		  'username' => $username,
		  'email' => $email,
		  'password' => $hashedPassword
		]);
	}

	/**
	 * @param $email
	 * @param $key
	 * @return mixed|stdClass|string
	 */
	public function activate($email, $key)
	{
		return $this->request->post('activate', [
		  'email' => $email,
		  'key' => $key
		]);
	}
}
<?php

namespace Mirarus\TeamSpeakDNS;

/**
 * Authorization
 *
 * @package    Mirarus\TeamSpeakDNS
 * @author     Ali Güçlü <aliguclutr@gmail.com>
 * @copyright  Copyright (c) 2024
 * @license    MIT
 * @version    1.0.1
 * @since      1.0.0
 */
class Authorization
{
	private $email;
	private $password;
	private $request;

	/**
	 * @param $email
	 * @param $password
	 */
	public function __construct($email, $password)
	{
		$this->email = $email;
		$this->password = $password;

		$this->request = new Request();
	}

	/**
	 * @return mixed
	 */
	public function login()
	{
		$hashedPassword = Hash::ts3Login($this->email, $this->password);

		$response = $this->request->post('login', [
		  'email' => $this->email,
		  'password' => $hashedPassword
		]);

		return $response->data ?? $response;
	}
}
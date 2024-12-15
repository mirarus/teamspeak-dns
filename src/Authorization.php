<?php

namespace Mirarus\TeamSpeakDNS;

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

		return $this->request->post('login', [
		  'email' => $this->email,
		  'password' => $hashedPassword
		])->data;
	}
}

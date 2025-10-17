<?php

namespace Mirarus\TeamSpeakDNS;

use stdClass;

/**
 * Authorization
 *
 * @package    Mirarus\TeamSpeakDNS
 * @author     Ali Güçlü <aliguclutr@gmail.com>
 * @copyright  Copyright (c) 2025
 * @license    MIT
 * @version    1.0.2
 * @since      1.0.0
 */
class Authorization
{
    private $email;
    private $password;
    private $request;
    
    /**
     * @param  string  $email
     * @param  string  $password
     */
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
        
        $this->request = new Request();
    }
    
    /**
     * @return array{email: string, password: string}
     */
    public function getUserCredentials(): array
    {
        $hashedPassword = Hash::ts3Login($this->email, $this->password);
        
        return [
          'email' => $this->email,
          'password' => $hashedPassword
        ];
    }
    
    /**
     * @return mixed|stdClass|string
     */
    public function login()
    {
        $response = $this->request->post('login', $this->getUserCredentials());
        
        return $response->data ?? $response;
    }
}
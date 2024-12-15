<?php

namespace Mirarus\TeamSpeakDNS;

class Authorization
{

    private $email;
    private $password;
    private $request;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
        
        $this->request = new Request();
    }

    public function login()
    {
        $hashedPassword = Hash::ts3Login($this->password, $this->email);

        $response = $this->request->post('login', [
            'email' => $this->email,
            'password' => $hashedPassword
        ])->data;

        return $response;
    }
}

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

    function login()
    {
        $hashedPassword = Hash::hashedPassword($this->password, $this->email);

        $response = $this->request->post('login', [
            'email' => $this->email,
            'password' => $hashedPassword
        ])->data;

        return $response;
    }
}
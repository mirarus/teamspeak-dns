<?php

namespace Mirarus\TeamSpeakDNS;

class Dns
{

    private $authorization;
    private $request;

    public function __construct(Authorization $authorization)
    {
        $this->authorization = $authorization;

        $this->request = new Request([
            'headers' => [
                'Authorization' => "Bearer " . $this->authorization->login()->sessionId
            ]
        ]);
    }

    public function list()
    {
        return $this->request->get('servers')->data;
    }

    public function create($name, $ip, int $port)
    {
        return $this->request->post('servers', [
            'nick' => $name,
            'target' => [
                "type" => "ip",
                "ipv4" => [
                    "host" => $ip,
                    "port" => $port
                ]
            ]
        ]);
    }

    public function update($sid, $name, $ip, int $port)
    {
        return $this->request->put('servers/' . $sid, [
            'typeModified' => false,
            'nick' => $name,
            'target' => [
                "type" => "ip",
                "ipv4" => [
                    "host" => $ip,
                    "port" => $port
                ]
            ]
        ]);
    }

    public function delete($sid)
    {
        return $this->request->delete('servers/' . $sid);
    }
}
<?php

namespace Mirarus\TeamSpeakDNS;

use stdClass;

class Dns
{
    private $authorization;
    private $request;

    /**
     * @param Authorization $authorization
     */
    public function __construct(Authorization $authorization)
    {
        $this->authorization = $authorization;

        $this->request = new Request([
            'headers' => [
                'Authorization' => "Bearer " . $this->authorization->login()->sessionId
            ]
        ]);
    }

    /**
     * @return mixed
     */
    public function list()
    {
        return $this->request->get('servers')->data;
    }

    /**
     * @param $name
     * @param $ip
     * @param int $port
     * @return mixed|stdClass|string
     */
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

    /**
     * @param $sid
     * @param $name
     * @param $ip
     * @param int $port
     * @return mixed|stdClass|string
     */
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

    /**
     * @param $sid
     * @return mixed|stdClass|string
     */
    public function delete($sid)
    {
        return $this->request->delete('servers/' . $sid);
    }
}
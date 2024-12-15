<?php

namespace Mirarus\TeamSpeakDNS;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class Request
{
    private $baseUri = "https://www.myteamspeak.com/api/";
    private $timeout = 2;
    private $sslVerify = false;
    private $options = [];
    private $client;

    public function __construct(array $options = [])
    {
        $this->options = $options;
        $this->client = $this->createClient();
    }

    private function createClient(): Client
    {
        $config = array_merge([
            'base_uri' => $this->baseUri,
            'timeout' => $this->timeout,
            'verify' => $this->sslVerify,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ], $this->options);

        return new Client($config);
    }

    private function createRequest($response)
    {
        $body = json_decode($response->getBody());

        if (!is_object($body)) {
            $body = new \stdClass();
        }
        $body->status = !(isset($body->code) && !empty($body->code));

        return $body;
    }

    public function post(string $endpoint, array $data = [])
    {
        try {

            $response = $this->client->post($endpoint, ['json' => $data]);
            return $this->createRequest($response);
        } catch (ClientException | RequestException | Exception $e) {
            return json_decode($e->getResponse()->getBody()) ?: $e->getMessage();
        }
    }

    public function get(string $endpoint)
    {
        try {

            $response = $this->client->get($endpoint);
            return $this->createRequest($response);
        } catch (ClientException | RequestException | Exception $e) {
            return json_decode($e->getResponse()->getBody()) ?: $e->getMessage();
        }
    }

    public function put(string $endpoint, array $data = [])
    {
        try {

            $response = $this->client->put($endpoint, ['json' => $data]);
            return $this->createRequest($response);
        } catch (ClientException | RequestException | Exception $e) {
            return json_decode($e->getResponse()->getBody()) ?: $e->getMessage();
        }
    }

    public function delete(string $endpoint)
    {
        try {

            $response = $this->client->delete($endpoint);
            return $this->createRequest($response);
        } catch (ClientException | RequestException | Exception $e) {
            return json_decode($e->getResponse()->getBody()) ?: $e->getMessage();
        }
    }
}
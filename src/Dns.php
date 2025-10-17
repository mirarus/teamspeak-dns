<?php

namespace Mirarus\TeamSpeakDNS;

use stdClass;

/**
 * Dns
 *
 * @package    Mirarus\TeamSpeakDNS
 * @author     Ali Güçlü <aliguclutr@gmail.com>
 * @copyright  Copyright (c) 2025
 * @license    MIT
 * @version    1.0.4
 * @since      1.0.0
 */
class Dns
{
	private $authorization;
	private $request;
	
	/**
	 * @param  Authorization  $authorization
	 */
	public function __construct(Authorization $authorization)
	{
		$this->authorization = $authorization;
		
		$this->request = new Request([
		  'headers' => [
			'Authorization' => "Bearer ".($this->authorization->login()->sessionId ?? '')
		  ]
		]);
	}
	
	/**
	 * @return stdClass
	 */
	public function list(): stdClass
	{
		$body = new stdClass();
		$body->items = [];
		$body->count = 0;
		
		$serverList = $this->request->get('servers');
		
		if (@$serverList->data) {
			foreach ($serverList->data->items as $item) {
				if ($item->data->target->type !== "IP") {
					continue;
				}
				
				$body->items[] = (object)[
				  'id' => str_replace('/servers/', '', $item->resources->self->uri),
				  'name' => $item->data->nick ?? '',
				  'host' => $item->data->target->ipv4->host ?? '',
				  'port' => $item->data->target->ipv4->port ?? ''
				];
			}
		}
		
		$body->count = count($body->items);
		
		return $body;
	}
	
	
	/**
	 * @param  string  $name
	 * @param  string  $host
	 * @param  int  $port
	 * @return mixed|stdClass|string
	 */
	public function create(string $name, string $host, int $port)
	{
		return $this->request->post('servers', [
		  'nick' => $name,
		  'target' => [
			"type" => "ip",
			"ipv4" => [
			  "host" => $host,
			  "port" => $port
			]
		  ]
		]);
	}
	
	/**
	 * @param  string  $id
	 * @param  string  $name
	 * @param  string  $host
	 * @param  int  $port
	 * @return mixed|stdClass|string
	 */
	public function update(string $id, string $name, string $host, int $port)
	{
		return $this->request->put('servers/'.$id, [
		  'typeModified' => false,
		  'nick' => $name,
		  'target' => [
			"type" => "ip",
			"ipv4" => [
			  "host" => $host,
			  "port" => $port
			]
		  ]
		]);
	}
	
	/**
	 * @param  string  $id
	 * @return mixed|stdClass|string
	 */
	public function delete(string $id)
	{
		return $this->request->post('servers/'.$id.'/delete', $this->authorization->getUserCredentials());
	}
}
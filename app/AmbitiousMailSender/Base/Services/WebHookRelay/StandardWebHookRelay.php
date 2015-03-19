<?php namespace App\AmbitiousMailSender\Base\Services\WebHookRelay;

use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;
use App\AmbitiousMailSender\Clients\Client;

class StandardWebHookRelay implements WebHookRelay {

	/**
	 * @param array       $vars
	 * @param Client      $client
	 * @param HttpRequest $httpRequest
	 * @return mixed
	 */
	public function relay($vars, Client $client, HttpRequest $httpRequest)
	{
		$url = $client->webHookEndPoint();
		$httpRequest->setAuth($client->name(), $client->apiKey());
		$httpRequest->post($url, $vars);
		return ($httpRequest->statusCode() == 200) ? true : false;
	}
}
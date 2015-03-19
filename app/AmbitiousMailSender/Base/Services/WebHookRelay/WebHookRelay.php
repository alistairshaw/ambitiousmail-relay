<?php namespace App\AmbitiousMailSender\Base\Services\WebHookRelay;

use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;
use App\AmbitiousMailSender\Clients\Client;

interface WebHookRelay {

	/**
	 * @param array       $vars
	 * @param Client      $client
	 * @param HttpRequest $httpRequest
	 * @return mixed
	 */
	public function relay($vars, Client $client, HttpRequest $httpRequest);

}
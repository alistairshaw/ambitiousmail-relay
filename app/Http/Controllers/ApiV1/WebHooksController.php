<?php namespace App\Http\Controllers\ApiV1;

use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;
use App\AmbitiousMailSender\Base\Services\WebHookReceiver\WebHookReceiver;
use App\AmbitiousMailSender\Base\Services\WebHookRelay\WebHookRelay;
use App\AmbitiousMailSender\Clients\ClientRepository;
use App\Http\Controllers\Controller;
use Request;

class WebHooksController extends Controller {

	public function index(WebHookReceiver $webHookReceiver, WebHookRelay $webHookRelay, ClientRepository $clientRepository, HttpRequest $httpRequest)
	{
		$vars = $webHookReceiver->receiveHook(Request::all());
		//todo: get client by checking the domain against campaigns or something?
		$webHookRelay->relay($vars, $client, $httpRequest);
	}

}
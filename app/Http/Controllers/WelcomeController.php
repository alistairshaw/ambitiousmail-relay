<?php namespace App\Http\Controllers;

use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;
use App\AmbitiousMailSender\Base\Services\Queue\RabbitMQQueue;
use Response;

class WelcomeController extends Controller {

	/**
	 * Create a new controller instance.
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index(HttpRequest $httpRequest)
	{
		$requestData = [
			'url' => Route('queueConsumerEmailSend'),
			'queue_name' => 'AmbitiousMailSenderEmailSend'
		];
		$httpRequest->post(Route('queueConsumerSetup'), $requestData, 1, true, false);
		var_dump(Route('queueConsumerSetup'));
		var_dump($requestData);
		dd("Ok");
	}

}

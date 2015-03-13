<?php namespace App\Http\Controllers\QueueConsumers;

use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;
use App\AmbitiousMailSender\Base\Services\Queue\Queue;
use Request;

class EmailsController extends QueueConsumerController {

	function index(Queue $queue, HttpRequest $httpRequest)
	{
		$message = Request::input('message');
		$msg = json_decode($message);



		$requestData = [
			'url' => Route('queueConsumerEmailSend'),
			'queue_name' => 'AmbitiousMailSenderEmailSend'
		];
		$httpRequest->post(Route('queueConsumerSetup'), $requestData, 1, true, false);
	}

}
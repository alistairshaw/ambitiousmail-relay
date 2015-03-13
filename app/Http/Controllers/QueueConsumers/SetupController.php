<?php namespace App\Http\Controllers\QueueConsumers;

use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;
use App\AmbitiousMailSender\Base\Services\Queue\Queue;
use App\Http\Controllers\Controller;
use Request;

class SetupController extends Controller {

	function index(Queue $queue, HttpRequest $httpRequest)
	{
		$url = Request::input('url');
		$queueName = Request::input('queue_name');

		if (!$url || !$queueName) exit('Invalid Queue or URL');

		$queue->start($queueName, $httpRequest);
		$queue->consume($url);
	}

}
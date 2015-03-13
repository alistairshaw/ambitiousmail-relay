<?php namespace App\Http\Controllers\QueueConsumers;

use App\AmbitiousMailSender\Base\Services\Queue\Queue;
use App\Http\Controllers\Controller;

class QueueConsumerController extends Controller {

	public function __construct(Queue $queue)
	{
		// whenever a queue consumer is called, we need to add a new consumer to replace the
		//  one we're using
		/*$queueName = Request::input('queue');
		$queueUrl = Request::input('url');
		$queue->start($queueName);
		$queue->consume($queueUrl);*/

	}

}
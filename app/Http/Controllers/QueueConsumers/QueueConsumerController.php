<?php namespace App\Http\Controllers\QueueConsumers;

use App\AmbitiousMailSender\Base\Services\Queue\Queue;
use App\Http\Controllers\Controller;

class QueueConsumerController extends Controller {

	public function __construct(Queue $queue)
	{

	}

}
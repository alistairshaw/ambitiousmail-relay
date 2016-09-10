<?php namespace App\Console\Commands;

use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;
use Illuminate\Console\Command;

class QueueConsumers extends Command {

	protected $name = 'QueueConsumers';

	protected $description = 'Set up Queue Consumers';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param HttpRequest $httpRequest
	 */
	public function fire(HttpRequest $httpRequest)
	{
		// the index is the name of the queue, the value is the URL the consumer should call to
		//     process the queue item
		$queues = array(
			'AmbitiousMailSenderEmailSend' => Route('queueConsumerEmailSend'),
		);

		$queue_consumer_url = Route('queueConsumerSetup');

        echo $queue_consumer_url;

		foreach ($queues as $queue_name => $url)
		{
			$requestData = [
				'url'        => $url,
				'queue_name' => $queue_name
			];
			$httpRequest->post($queue_consumer_url, $requestData, 1, true, false);
		}
	}
}
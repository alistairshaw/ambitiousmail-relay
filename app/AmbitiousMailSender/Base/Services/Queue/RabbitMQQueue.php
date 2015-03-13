<?php namespace App\AmbitiousMailSender\Base\Services\Queue;

use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;
use Log;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQQueue implements Queue {

	/**
	 * Queue Name
	 * @var string
	 */
	private $queue;

	/**
	 * Current consumer count for the queue
	 * @var int
	 */
	private $consumer_count;

	/**
	 * Maximum number of consumers to maintain
	 * @var int
	 */
	private $consumer_max = 3;

	/**
	 * URL to call when consuming a queue message
	 * @var string
	 */
	private $consumer_url = null;

	/**
	 * Rabbit MQ server details
	 * @var string
	 */
	private $host = 'localhost';

	/**
	 * @var int
	 */
	private $port = 5672;

	/**
	 * @var string
	 */
	private $user = 'guest';

	/**
	 * @var string
	 */
	private $pass = 'guest';

	/**
	 * Timeout in seconds
	 * @var int
	 */
	private $ttl = 120;

	/**
	 * @var null
	 */
	private $consumer_start = null;

	/**
	 * Variables we post to our consumer processor
	 * @var array
	 */
	private $consumer_post = array();

	/**
	 * @var HttpRequest
	 */
	private $httpRequest;

	/**
	 * @param string      $queue
	 */
	public function start($queue, HttpRequest $httpRequest)
	{
		$this->queue = $queue;
		$this->httpRequest = $httpRequest;

		$this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->pass);
		$this->channel    = $this->connection->channel();

		list(, , $consumer_count) = $this->channel->queue_declare($this->queue, false, false, false, false);
		$this->consumer_count = $consumer_count;
	}

	/**
	 * @param string $message
	 */
	public function produce($message)
	{
		$message = new AMQPMessage($message);
		$this->channel->basic_publish($message, '', $this->queue);
	}

	/**
	 * Listener for the queue
	 * @param string $consumer_url
	 * @param array  $post_vars
	 */
	public function consume($consumer_url, $post_vars = array())
	{
		$this->consumer_url  = $consumer_url;
		$this->consumer_post = $post_vars;

		if ($this->consumer_count < $this->consumer_max)
		{
			$this->consumer_start = time();

			$callback = function (AMQPMessage $message)
			{
				$post_vars            = $this->consumer_post;
				$post_vars['url']     = $this->consumer_url;
				$post_vars['queue']   = $this->queue;
				$post_vars['message'] = $message->body;

				$response = $this->httpRequest->post($this->consumer_url, $post_vars);
				$code = $this->httpRequest->statusCode();

				if ($code == 200)
				{
					$message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
				}
				else
				{
					// log the error to a file
					$log_message = $code . "\n\n";
					$log_message .= $message->body . "\n\n";
					$log_message .= print_r($message, true);
					$log_message .= "\n\n\n";
					$log_message .= print_r($response, true);
					Log::error($log_message);
				}

				if (($this->consumer_start + $this->ttl) < time())
				{
					$this->channel->basic_cancel($message->delivery_info['consumer_tag']);
				}
			};

			$this->channel->basic_consume($this->queue, '', false, false, false, false, $callback);

			while (count($this->channel->callbacks))
			{
				$this->channel->wait();
			}
		}
	}

	/**
	 * Close the connection
	 */
	public function end()
	{
		$this->channel->close();
		$this->connection->close();
	}

}
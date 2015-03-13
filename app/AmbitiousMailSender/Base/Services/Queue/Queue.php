<?php namespace App\AmbitiousMailSender\Base\Services\Queue;

use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;

interface Queue {

	/**
	 * @param string      $queue
	 * @param HttpRequest $httpRequest
	 * @return
	 */
	public function start($queue, HttpRequest $httpRequest);

	/**
	 * @param $message
	 */
	public function produce($message);

	/**
	 * @param $url
	 */
	public function consume($url);

	/**
	 * End queue interaction
	 */
	public function end();

}
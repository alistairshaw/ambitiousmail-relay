<?php namespace App\AmbitiousMailSender\Base\Services\WebHookReceiver;

interface WebHookReceiver {

	/**
	 * @param $vars
	 * @return array
	 */
	public function receiveHook($vars);

}
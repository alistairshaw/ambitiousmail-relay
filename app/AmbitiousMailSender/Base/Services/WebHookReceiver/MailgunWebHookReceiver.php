<?php namespace App\AmbitiousMailSender\Base\Services\WebHookReceiver;

class MailgunWebHookReceiver extends AbstractWebHookReceiver implements WebHookReceiver {

	/**
	 * @param $vars
	 * @return array
	 */
	public function receiveHook($vars)
	{
		$final = [
			'domain' => $vars['domain'],
			'event' => $vars['event'],
			'recipient' => $vars['recipient']
		];

		return $final;
	}
}
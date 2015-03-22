<?php

use App\AmbitiousMailSender\Base\ValueObjects\Email;
use App\AmbitiousMailSender\Campaigns\Campaign;
use App\AmbitiousMailSender\Clients\Client;

class MailHookTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testMailHook()
	{
		$campaignData['client_id'] = 1;
		$campaignData['domain'] = 'mg.amsvr.co.uk';
		$campaignData['mail_from'] = new Email('alistair@mg.amsvr.co.uk');

		$clientData['name'] = 'vendirun';
		$clientData['api_key'] = 'pra869z5';
		$clientData['web_hook_end_point'] = 'http://app.vendirun.local/api/v1/mailwebhook';

		$campaign = new Campaign($campaignData);
		$client = new Client($clientData);
		$webHookRelay = new App\AmbitiousMailSender\Base\Services\WebHookRelay\StandardWebHookRelay();

		$vars = [
			'domain' => 'mg.amsvr.co.uk',
			'event' => 'dropped',
			'recipient' => 'alistair.grimes@rocketsciencelab.co.uk'
		];

		$result = $webHookRelay->relay($vars, $client, new \App\AmbitiousMailSender\Base\Services\HttpRequest\GuzzleHttpRequest());

		$this->assertEquals($campaign->domain(), 'mg.amsvr.co.uk');
		$this->assertEquals($result, true);
	}

}

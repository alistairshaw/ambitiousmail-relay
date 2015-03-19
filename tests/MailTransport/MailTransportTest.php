<?php

use App\AmbitiousMailSender\Base\Services\MailTransport\MockMailTransport;
use App\AmbitiousMailSender\Base\ValueObjects\Email;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmail;
use App\AmbitiousMailSender\Campaigns\Campaign;

class MailTransportTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testMailContent()
	{
		$campaignData['subjectLine'] = 'This is my subject';
		$campaignData['html']        = '<p>Something something <a href="[[unsubscribe]]">Unsubscribe</a></p>';
		$campaign                    = new Campaign($campaignData);

		$campaignEmailData = [
			'variables' => [
				'first_name'  => 'Alistair',
				'last_name'   => 'Shaw',
				'unsubscribe' => 'http://this.is.a/link.html'
			],
			'emailAddress' => new Email('alistairshaw@gmail.com')
		];
		$campaignEmail     = new CampaignEmail($campaignEmailData);

		$mailTransport = new MockMailTransport();
		$mail          = $mailTransport->send($campaign, $campaignEmail);
		$this->assertEquals($mail['subject'], $campaignData['subjectLine']);
		$this->assertEquals($mail['to'], 'Alistair Shaw <alistairshaw@gmail.com>');
		$this->assertEquals($mail['html'], '<p>Something something <a href="http://this.is.a/link.html">Unsubscribe</a></p>');
	}

}

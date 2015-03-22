<?php

use App\AmbitiousMailSender\CampaignEmails\CampaignEmailFactory;

class CampaignEmailFactoryTest extends TestCase {

	/**
	 * @var CampaignEmailFactory
	 */
	private $campaignEmailFactory;

	function setUp()
	{
		$this->campaignEmailFactory = new CampaignEmailFactory();
	}

	public function tearDown() {
		Mockery::close();
	}

	/**
	 * @test
	 */
	function campaign_email_factory_returns_instance_of_campaign_email()
	{
		$campaignEmail = $this->campaignEmailFactory->create([]);
		$this->assertInstanceOf('App\AmbitiousMailSender\CampaignEmails\CampaignEmail', $campaignEmail);
	}

	/**
	 * @test
	 */
	function converts_email_string_to_email_object_on_create()
	{
		$campaignEmail = $this->campaignEmailFactory->create([
			'id' => 1,
			'email_address' => 'alistairshaw@gmail.com'
		]);
		$this->assertInstanceOf('App\AmbitiousMailSender\CampaignEmails\CampaignEmail', $campaignEmail);
		$this->assertEquals('alistairshaw@gmail.com', $campaignEmail->emailAddress());
	}

}
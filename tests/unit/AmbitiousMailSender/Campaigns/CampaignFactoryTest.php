<?php

class CampaignFactoryTest extends TestCase {

	/**
	 * @test
	 */
	function create_returns_instance_of_campaign()
	{
		$campaignFactory = new \App\AmbitiousMailSender\Campaigns\CampaignFactory();
		$campaign = $campaignFactory->create([]);

		$this->assertInstanceOf('\App\AmbitiousMailSender\Campaigns\Campaign', $campaign);
	}

	/**
	 * @test
	 */
	function converts_snake_case_keys_to_camel_case()
	{
		$campaignFactory = new \App\AmbitiousMailSender\Campaigns\CampaignFactory();
		$campaign = $campaignFactory->create([
			'from_email'=>'alistairshaw@gmail.com'
		]);

		$this->assertInstanceOf('\App\AmbitiousMailSender\Campaigns\Campaign', $campaign);
	}

	/**
	 * @test
	 */
	function allows_reply_to_or_bounce_email_to_be_set_but_empty()
	{
		$campaignFactory = new \App\AmbitiousMailSender\Campaigns\CampaignFactory();
		$campaign = $campaignFactory->create([
			'from_email'=>'alistairshaw@gmail.com',
			'reply_to_email'=>'',
			'bounce_email'=>''
		]);

		$this->assertInstanceOf('\App\AmbitiousMailSender\Campaigns\Campaign', $campaign);
	}

}
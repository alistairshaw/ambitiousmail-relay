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

}
<?php

class CampaignEventFactoryTest extends TestCase {

	/**
	 * @test
	 */
	function create_returns_instance_of_campaign_event()
	{
		$campaignEventFactory = new \App\AmbitiousMailSender\CampaignEvents\CampaignEventFactory();
		$campaignEvent = $campaignEventFactory->create([]);

		$this->assertInstanceOf('\App\AmbitiousMailSender\CampaignEvents\CampaignEvent', $campaignEvent);
	}

}
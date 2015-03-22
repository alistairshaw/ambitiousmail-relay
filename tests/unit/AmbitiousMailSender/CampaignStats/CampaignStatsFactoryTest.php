<?php

class CampaignStatsFactory extends TestCase {

	/**
	 * @test
	 */
	function create_returns_instance_of_campaign_stats()
	{
		$campaignStatsFactory = new \App\AmbitiousMailSender\CampaignStats\CampaignStatsFactory();
		$campaignStats = $campaignStatsFactory->create([]);

		$this->assertInstanceOf('\App\AmbitiousMailSender\CampaignStats\CampaignStats', $campaignStats);
	}

}
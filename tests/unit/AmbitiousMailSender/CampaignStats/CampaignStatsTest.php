<?php

use App\AmbitiousMailSender\CampaignStats\CampaignStats;
use App\AmbitiousMailSender\Base\ValueObjects\DateTime;

class CampaignStatsTest extends TestCase {

	/**
	 * @var array
	 */
	private $campaignStatsData;

	function setUp()
	{
		parent::setUp();

		$createdTimestamp = strtotime('2015-03-01 09:25:37');
		$updatedTimestamp = strtotime('2015-03-05 19:15:32');

		$this->campaignStatsData = [
			'id' => 1,
			'submitted' => 150,
			'delivered' => 140,
			'dropped' => 8,
			'bounced' => 15,
			'clicked' => 22,
			'opened' => 72,
			'complained' => 0,
			'createdAt' => new DateTime($createdTimestamp),
			'updatedAt' => new DateTime($updatedTimestamp)
		];
	}

	/**
	 * @test
	 */
	function it_can_be_instantiated_with_no_data()
	{
		$campaign = new CampaignStats([]);
		$this->assertEquals(null, $campaign->id());
	}

	/**
	 * @test
	 */
	function it_has_some_fields_that_can_be_set_and_recalled()
	{
		$campaign = new CampaignStats($this->campaignStatsData);
		$statsArray = [
			'submitted' => 150,
			'delivered' => 140,
			'delivering' => 2,
			'dropped' => 8,
			'bounced' => 15,
			'clicked' => 22,
			'opened' => 72,
			'complained' => 0
		];

		$this->assertEquals($statsArray, $campaign->stats());
		$this->assertEquals(1, $campaign->id());
	}

	/**
	 * @test
	 * @expectedException \App\AmbitiousMailSender\Base\Exceptions\InvalidArgumentException
	 */
	function throws_exception_if_passed_an_invalid_key()
	{
		new CampaignStats([
			'fake' => 'something'
		]);
	}

}
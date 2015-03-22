<?php

use App\AmbitiousMailSender\Base\ValueObjects\Email;
use App\AmbitiousMailSender\CampaignEvents\CampaignEvent;
use App\AmbitiousMailSender\Base\ValueObjects\DateTime;

class CampaignEventTest extends TestCase {

	/**
	 * @var array
	 */
	private $campaignEventData;

	function setUp()
	{
		parent::setUp();

		$createdTimestamp = strtotime('2015-03-01 09:25:37');
		$updatedTimestamp = strtotime('2015-03-05 19:15:32');

		$this->campaignEventData = [
			'id' => 1,
			'tags' => ['one', 'two'],
			'event' => 'dropped',
			'recipient' => new Email('alistairshaw@gmail.com'),
			'createdAt' => new DateTime($createdTimestamp),
			'updatedAt' => new DateTime($updatedTimestamp)
		];
	}

	/**
	 * @test
	 */
	function it_can_be_instantiated_with_no_data()
	{
		$campaignEvent = new CampaignEvent([]);
		$this->assertEquals('', $campaignEvent->event());
		$this->assertEquals(null, $campaignEvent->recipient());
	}

	/**
	 * @test
	 */
	function it_has_some_fields_that_can_be_set_and_recalled()
	{
		$campaignEvent = new CampaignEvent($this->campaignEventData);
		$this->assertEquals(1, $campaignEvent->id());
		$this->assertEquals(['one', 'two'], $campaignEvent->tags());
		$this->assertEquals('dropped', $campaignEvent->event());
		$this->assertEquals('alistairshaw@gmail.com', $campaignEvent->recipient());
		$this->assertEquals('2015-03-01 09:25:37', $campaignEvent->createdAt());
		$this->assertEquals('2015-03-05 19:15:32', $campaignEvent->updatedAt());
	}

	/**
	 * @test
	 * @expectedException \App\AmbitiousMailSender\Base\Exceptions\InvalidArgumentException
	 */
	function throws_exception_if_passed_an_invalid_key()
	{
		new CampaignEvent([
			'fake' => 'something'
		]);
	}

	/**
	 * @test
	 *
	 * @expectedException ErrorException
	 */
	function throws_exception_if_from_email_is_not_an_instance_of_email()
	{
		$this->campaignEventData['recipient'] = 'alistairshaw@gmail.com';
		new CampaignEvent($this->campaignEventData);
	}

}
<?php

use App\AmbitiousMailSender\Base\ValueObjects\Email;
use App\AmbitiousMailSender\Base\ValueObjects\DateTime;
use App\AmbitiousMailSender\Campaigns\Campaign;

class CampaignTest extends TestCase {

	private $campaignData;

	function setUp()
	{
		$createdTimestamp = strtotime('2015-03-01 09:25:37');
		$updatedTimestamp = strtotime('2015-03-05 19:15:32');

		$this->campaignData = [
			'id' => 1,
			'remoteCampaignId' => 'fJFur',
			'campaignName' => 'Test Campaign',
			'subjectLine' => 'This is a test campaign',
			'fromName' => 'Alistair Shaw',
			'trackOpens' => true,
			'trackClicks' => false,
			'html' => '<p>This is a test</p>',
			'plaintext' => 'This is a test',
			'fromEmail' => new Email('alistairshaw@gmail.com'),
			'replyToEmail' => new Email('alistairshaw2@gmail.com'),
			'bounceEmail' => new Email('alistairshaw3@gmail.com'),
			'domain' => 'gmail.com',
			'createdAt' => new DateTime($createdTimestamp),
			'updatedAt' => new DateTime($updatedTimestamp)
		];
	}

	/**
	 * @test
	 */
	function it_can_be_instantiated_with_no_data()
	{
		$campaign = new Campaign([]);
		$this->assertEquals('', $campaign->campaignName());
		$this->assertEquals(null, $campaign->fromEmail());
	}

	/**
	 * @test
	 */
	function it_has_some_fields_that_can_be_set_and_recalled()
	{
		$campaign = new Campaign($this->campaignData);
		$this->assertEquals(1, $campaign->id());
		$this->assertEquals('fJFur', $campaign->remoteCampaignId());
		$this->assertEquals('Test Campaign', $campaign->campaignName());
		$this->assertEquals('This is a test campaign', $campaign->subjectLine());
		$this->assertEquals('Alistair Shaw', $campaign->fromName());
		$this->assertEquals(true, $campaign->trackOpens());
		$this->assertEquals(false, $campaign->trackClicks());
		$this->assertEquals('<p>This is a test</p>', $campaign->html());
		$this->assertEquals('This is a test', $campaign->plaintext());
		$this->assertEquals('alistairshaw@gmail.com', $campaign->fromEmail());
		$this->assertEquals('alistairshaw2@gmail.com', $campaign->replyToEmail());
		$this->assertEquals('alistairshaw3@gmail.com', $campaign->bounceEmail());
		$this->assertEquals('gmail.com', $campaign->domain());
		$this->assertEquals('2015-03-01 09:25:37', $campaign->createdAt());
		$this->assertEquals('2015-03-05 19:15:32', $campaign->updatedAt());
	}

	/**
	 * @test
	 */
	function tracking_variables_can_be_integers()
	{
		$this->campaignData['trackOpens'] = 1;
		$this->campaignData['trackClicks'] = 0;
		$campaign = new Campaign($this->campaignData);
		$this->assertEquals(true, $campaign->trackOpens());
		$this->assertEquals(false, $campaign->trackClicks());
	}

	/**
	 * @test
	 * @expectedException \App\AmbitiousMailSender\Base\Exceptions\InvalidArgumentException
	 */
	function throws_exception_if_passed_an_invalid_key()
	{
		new Campaign([
			'fake' => 'something'
		]);
	}

	/**
	 * @test
	 */
	function emails_should_be_instance_of_email_value_object()
	{
		$campaign = new Campaign([
			'campaignName' => 'Test Campaign',
			'fromEmail' => new Email('alistairshaw@gmail.com'),
			'replyToEmail' => new Email('alistairshaw2@gmail.com'),
			'bounceEmail' => new Email('alistairshaw3@gmail.com')
		]);

		$this->assertEquals('alistairshaw@gmail.com', $campaign->fromEmail());
		$this->assertEquals('alistairshaw2@gmail.com', $campaign->replyToEmail());
		$this->assertEquals('alistairshaw3@gmail.com', $campaign->bounceEmail());
	}

	/**
	 * @test
	 *
	 * @expectedException ErrorException
	 */
	function throws_exception_if_from_email_is_not_an_instance_of_email()
	{
		new Campaign([
			'campaignName' => 'Test Campaign',
			'fromEmail' => 'alistairshaw@gmail.com'
		]);
	}

	/**
	 * @test
	 *
	 * @expectedException ErrorException
	 */
	function throws_exception_if_reply_to_email_is_not_an_instance_of_email()
	{
		new Campaign([
			'campaignName' => 'Test Campaign',
			'replyToEmail' => 'alistairshaw@gmail.com'
		]);
	}

	/**
	 * @test
	 *
	 * @expectedException ErrorException
	 */
	function throws_exception_if_bounce_email_is_not_an_instance_of_email()
	{
		new Campaign([
			'campaignName' => 'Test Campaign',
			'bounceEmail' => 'alistairshaw@gmail.com'
		]);
	}

}
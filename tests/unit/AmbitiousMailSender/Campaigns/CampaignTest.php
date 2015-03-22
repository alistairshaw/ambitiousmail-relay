<?php

use App\AmbitiousMailSender\Base\ValueObjects\Email;
use App\AmbitiousMailSender\Campaigns\Campaign;

class CampaignTest extends TestCase {

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
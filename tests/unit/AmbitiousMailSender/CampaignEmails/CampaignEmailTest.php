<?php

use App\AmbitiousMailSender\Base\ValueObjects\Email;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmail;

class CampaignEmailTest extends TestCase {

	var $campaignEmailData;

	function setUp()
	{
		$this->campaignEmailData = [
			'id' => 1,
			'campaignId' => 2,
			'emailAddress' => new Email('alistairshaw@gmail.com'),
			'variables' => ['var1' => 'test', 'var2' => 'test']
		];
	}

	/**
	 * @test
	 */
	function it_can_be_instantiated_with_no_data()
	{
		$campaignEmail = new CampaignEmail([]);
		$this->assertEquals('', $campaignEmail->campaignId());
		$this->assertEquals(null, $campaignEmail->emailAddress());
	}

	/**
	 * @test
	 */
	function it_has_some_fields_that_can_be_set_and_recalled()
	{
		$campaignEmail = new CampaignEmail($this->campaignEmailData);
		$this->assertEquals(1, $campaignEmail->id());
		$this->assertEquals(2, $campaignEmail->campaignId());
		$this->assertEquals('alistairshaw@gmail.com', $campaignEmail->emailAddress());
		$this->assertEquals(['var1' => 'test', 'var2' => 'test'], $campaignEmail->variables());
	}

	/**
	 * @test
	 * @expectedException \App\AmbitiousMailSender\Base\Exceptions\InvalidArgumentException
	 */
	function throws_exception_if_passed_an_invalid_key()
	{
		$this->campaignEmailData['extraFake'] = 'something';
		new CampaignEmail($this->campaignEmailData);
	}

	/**
	 * @test
	 * @expectedException ErrorException
	 */
	function throws_exception_if_email_is_not_an_instance_of_email()
	{
		$this->campaignEmailData['emailAddress'] = 'alistairshaw@gmail.com';
		new CampaignEmail($this->campaignEmailData);
	}

	/**
	 * @test
	 */
	function get_email_domain_returns_domain()
	{
		$campaignEmail = new CampaignEmail($this->campaignEmailData);
		$this->assertEquals('gmail.com', $campaignEmail->getEmailDomain());
	}
}
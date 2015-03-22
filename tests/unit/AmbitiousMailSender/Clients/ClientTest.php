<?php

use App\AmbitiousMailSender\Clients\Client;
use App\AmbitiousMailSender\Base\ValueObjects\DateTime;

class ClientTest extends TestCase {

	/**
	 * @var array
	 */
	private $clientData;

	function setUp()
	{
		parent::setUp();

		$createdTimestamp = strtotime('2015-03-01 09:25:37');
		$updatedTimestamp = strtotime('2015-03-05 19:15:32');

		$this->clientData = [
			'id' => 1,
			'name' => 'Vendirun',
			'apiKey' => '123456',
			'webHookEndPoint' => 'http://my.web/hook',
			'createdAt' => new DateTime($createdTimestamp),
			'updatedAt' => new DateTime($updatedTimestamp)
		];
	}

	/**
	 * @test
	 */
	function it_can_be_instantiated_with_no_data()
	{
		$client = new Client([]);
		$this->assertEquals('', $client->name());
	}

	/**
	 * @test
	 */
	function it_has_some_fields_that_can_be_set_and_recalled()
	{
		$client = new Client($this->clientData);
		$this->assertEquals(1, $client->id());
		$this->assertEquals('Vendirun', $client->name());
		$this->assertEquals('123456', $client->apiKey());
		$this->assertEquals('http://my.web/hook', $client->webHookEndPoint());
		$this->assertEquals('2015-03-01 09:25:37', $client->createdAt());
		$this->assertEquals('2015-03-05 19:15:32', $client->updatedAt());
	}

	/**
	 * @test
	 * @expectedException \App\AmbitiousMailSender\Base\Exceptions\InvalidArgumentException
	 */
	function throws_exception_if_passed_an_invalid_key()
	{
		new Client([
			'fake' => 'something'
		]);
	}

}
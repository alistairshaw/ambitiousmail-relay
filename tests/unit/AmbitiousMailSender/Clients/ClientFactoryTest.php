<?php

class ClientFactoryTest extends TestCase {

	/**
	 * @test
	 */
	function create_returns_instance_of_client()
	{
		$clientFactory = new \App\AmbitiousMailSender\Clients\ClientFactory();
		$client = $clientFactory->create([]);

		$this->assertInstanceOf('\App\AmbitiousMailSender\Clients\Client', $client);
	}

	/**
	 * @test
	 */
	function converts_snake_case_keys_to_camel_case()
	{
		$clientFactory = new \App\AmbitiousMailSender\Clients\ClientFactory();
		$client = $clientFactory->create([
			'api_key'=>'123456'
		]);

		$this->assertInstanceOf('\App\AmbitiousMailSender\Clients\Client', $client);
	}

	/**
	 * @test
	 */
	function created_at_must_be_converted_to_an_instance_of_date_time_value_object()
	{
		$clientFactory = new \App\AmbitiousMailSender\Clients\ClientFactory();
		$client = $clientFactory->create([
			'createdAt'=>'2014-05-06 12:42:12'
		]);
	}

}
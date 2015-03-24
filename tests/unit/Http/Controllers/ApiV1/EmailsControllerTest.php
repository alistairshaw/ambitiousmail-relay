<?php

use App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository;
use App\AmbitiousMailSender\Base\Services\Queue\Queue;
use App\AmbitiousMailSender\Clients\Client;
use App\AmbitiousMailSender\Clients\ClientRepository;

class EmailsControllerTest extends TestCase {

	/**
	 * @var ClientRepository
	 */
	private $clientRepository;

	/**
	 * @var CampaignEmailRepository
	 */
	private $campaignEmailRepository;

	/**
	 * @var Queue
	 */
	private $queue;

	public function setUp()
	{
		parent::setUp();

		// we need to mock the clientRepository for authentication
		$this->clientRepository = Mockery::mock('App\AmbitiousMailSender\Clients\ClientRepository', 'ClientRepository');
		$this->app->instance('App\AmbitiousMailSender\Clients\ClientRepository', $this->clientRepository);
		$this->clientRepository->shouldReceive('findByName')->with('user')->andReturn(new Client(['id'=>1, 'apiKey'=>'secret']));
	}

	public function tearDown() {
		parent::tearDown();
		Mockery::close();
	}

	/**
	 * @test
	 */
	function testStore()
	{
		// Mock CampaignEmailRepository
		$this->campaignEmailRepository = Mockery::mock('App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository', 'campaignEmailRepository');
		$this->app->instance('App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository', $this->campaignEmailRepository);
		$this->campaignEmailRepository->shouldReceive('save')->times(3);

		// Mock Queue
		$this->queue = Mockery::mock('App\AmbitiousMailSender\Base\Services\Queue\Queue', 'queue');
		$this->app->instance('App\AmbitiousMailSender\Base\Services\Queue\Queue', $this->queue);

		$this->queue->shouldReceive('start')->once();
		$this->queue->shouldReceive('produce')->once();

		// expects a list of emails in the form of a json array, we'll pass through 3 for testing
		$emails = [
			['email_address' => 'test1@gmail.com', 'variables' => ''],
			['email_address' => 'test2@gmail.com', 'variables' => ''],
			['email_address' => 'test3@gmail.com', 'variables' => '']
		];

		$postData = [
			'campaignId' => 50,
			'emails'     => json_encode($emails)
		];

		$this->action('POST', 'ApiV1\EmailsController@store', $postData, [], [], [], ['PHP_AUTH_USER'=>'user', 'PHP_AUTH_PW'=>'secret']);

		$this->assertResponseOk();
		$this->assertViewHas('apiResponse', ['success' => 1, 'response' => ['received'=>3], 'message' => '']);
	}

	/**
	 * @test
	 */
	function testStoreWithNoEmails()
	{
		// Mock CampaignEmailRepository
		$this->campaignEmailRepository = Mockery::mock('App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository', 'campaignEmailRepository');
		$this->app->instance('App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository', $this->campaignEmailRepository);
		$this->campaignEmailRepository->shouldNotReceive('save');

		// Mock Queue
		$this->queue = Mockery::mock('App\AmbitiousMailSender\Base\Services\Queue\Queue', 'queue');
		$this->app->instance('App\AmbitiousMailSender\Base\Services\Queue\Queue', $this->queue);

		$this->queue->shouldNotReceive('start');
		$this->queue->shouldNotReceive('produce');

		// expects a list of emails in the form of a json array, we'll pass through 3 for testing
		$emails = [];

		$postData = [
			'campaignId' => 50,
			'emails'     => json_encode($emails)
		];

		$this->action('POST', 'ApiV1\EmailsController@store', $postData, [], [], [], ['PHP_AUTH_USER'=>'user', 'PHP_AUTH_PW'=>'secret']);

		$this->assertResponseOk();
		$this->assertViewHas('apiResponse', ['success' => 1, 'response' => ['received'=>0], 'message' => '']);
	}

	/**
	 * @test
	 */
	function testStoreWithInvalidEmails()
	{
		// Mock CampaignEmailRepository
		$this->campaignEmailRepository = Mockery::mock('App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository', 'campaignEmailRepository');
		$this->app->instance('App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository', $this->campaignEmailRepository);
		$this->campaignEmailRepository->shouldReceive('save')->times(2);

		// Mock Queue
		$this->queue = Mockery::mock('App\AmbitiousMailSender\Base\Services\Queue\Queue', 'queue');
		$this->app->instance('App\AmbitiousMailSender\Base\Services\Queue\Queue', $this->queue);

		$this->queue->shouldReceive('start')->once();
		$this->queue->shouldReceive('produce')->once();

		// expects a list of emails in the form of a json array, we'll pass through 3 for testing
		$emails = [
			['email_address' => 'test1@gmail.com', 'variables' => ''],
			['email_address' => 'test2@gmail.com', 'variables' => ''],
			['email_address' => 'test3gmail.com', 'variables' => '']
		];

		$postData = [
			'campaignId' => 50,
			'emails'     => json_encode($emails)
		];

		$this->action('POST', 'ApiV1\EmailsController@store', $postData, [], [], [], ['PHP_AUTH_USER'=>'user', 'PHP_AUTH_PW'=>'secret']);

		$this->assertResponseOk();
		$this->assertViewHas('apiResponse', ['success' => 1, 'response' => ['received'=>2], 'message' => '']);
	}

}
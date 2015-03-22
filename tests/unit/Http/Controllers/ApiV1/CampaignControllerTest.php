<?php

use App\AmbitiousMailSender\Base\ValueObjects\Email;
use App\AmbitiousMailSender\Campaigns\CampaignRepository;
use App\AmbitiousMailSender\CampaignStats\CampaignStatsRepository;

class CampaignControllerTest extends TestCase {

	/**
	 * @var CampaignRepository
	 */
	protected $campaignRepository;

	/**
	 * @var CampaignStatsRepository
	 */
	protected $campaignStatsRepository;

	function setUp()
	{
		parent::setUp();
	}

	/**
	 * @test
	 */
	function testStore()
	{
		$this->app->client_id = 1;

		$campaignData = [
			'campaign_name' => 'Test Campaign',
			'subject_line' => 'This is a test',
			'from_name' => 'Alistair Shaw',
			'track_opens' => 1,
			'track_clicks' => 1,
			'html' => '<p>This is a test email</p>',
			'plaintext' => 'This is a test email',
			'from_email' => 'alistairshaw@gmail.com',
			'reply_to_email' => 'alistairshaw2@gmail.com',
			'bounce_email' => 'alistairshaw3@gmail.com',
			'domain' => 'gmail.com'
		];

		$this->campaignRepository = Mockery::mock('App\AmbitiousMailSender\Campaigns\CampaignRepository', 'CampaignRepository');
		$this->campaignRepository->shouldReceive('save')->once()->andReturn(new \App\AmbitiousMailSender\Campaigns\Campaign(['id'=>50]));
		$this->app->instance('App\AmbitiousMailSender\Campaigns\CampaignRepository', $this->campaignRepository);

		$this->action('POST', 'ApiV1\CampaignController@store', $campaignData);
		$this->assertResponseOk();
		$this->assertViewHas('apiResponse', ['success'=>1, 'response'=>['id'=>50], 'message'=>'']);
	}

	/**
	 * @test
	 */
	function testShow()
	{
		$campaignData = [
			'id'=>50,
			'domain'=>'gmail.com',
			'fromEmail'=>new Email('alistairshaw@gmail.com'),
			'remoteCampaignId'=>'hyght'
		];

		$this->campaignRepository = Mockery::mock('App\AmbitiousMailSender\Campaigns\CampaignRepository', 'CampaignRepository');
		$this->campaignRepository->shouldReceive('find')->once()->andReturn(new \App\AmbitiousMailSender\Campaigns\Campaign($campaignData));
		$this->app->instance('App\AmbitiousMailSender\Campaigns\CampaignRepository', $this->campaignRepository);

		$campaignStatsData = [
			'id' => 1,
			'submitted' => 100,
			'delivered' => 60,
			'dropped' => 10,
			'bounced' => 5,
			'clicked' => 60,
			'opened' => 55,
			'complained' => 0
		];

		$this->campaignStatsRepository = Mockery::mock('App\AmbitiousMailSender\CampaignStats\CampaignStatsRepository', 'CampaignStatsRepository');
		$this->campaignStatsRepository->shouldReceive('setDomain')->with('gmail.com');
		$this->campaignStatsRepository->shouldReceive('find')->with('hyght')->once()->andReturn(new \App\AmbitiousMailSender\CampaignStats\CampaignStats($campaignStatsData));
		$this->app->instance('App\AmbitiousMailSender\CampaignStats\CampaignStatsRepository', $this->campaignStatsRepository);

		$this->action('GET', 'ApiV1\CampaignController@show', ['campaignId'=>50]);

		unset($campaignStatsData['id']);
		$campaignStatsData['delivering'] = 30;

		$this->assertResponseOk();
		$this->assertViewHas('apiResponse', ['success'=>1, 'response'=>$campaignStatsData, 'message'=>'']);
	}

}
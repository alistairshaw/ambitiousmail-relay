<?php

use App\AmbitiousMailSender\Base\ValueObjects\Email;
use App\AmbitiousMailSender\CampaignEvents\CampaignEvent;
use App\AmbitiousMailSender\CampaignEvents\CampaignEventRepository;
use App\AmbitiousMailSender\Campaigns\CampaignRepository;
use Illuminate\Support\Collection;

class CampaignEventsControllerTest extends TestCase {

	/**
	 * @var CampaignRepository
	 */
	protected $campaignRepository;

	/**
	 * @var CampaignEventRepository
	 */
	protected $campaignEventRepository;

	function testShow()
	{
		$campaignData = [
			'id'               => 50,
			'domain'           => 'gmail.com',
			'fromEmail'        => new Email('alistairshaw@gmail.com'),
			'remoteCampaignId' => 'hyght'
		];

		$this->campaignRepository = Mockery::mock('App\AmbitiousMailSender\Campaigns\CampaignRepository', 'CampaignRepository');
		$this->app->instance('App\AmbitiousMailSender\Campaigns\CampaignRepository', $this->campaignRepository);
		$this->campaignRepository->shouldReceive('find')->with(50)->once()->andReturn(new \App\AmbitiousMailSender\Campaigns\Campaign($campaignData));

		$this->campaignEventRepository = Mockery::mock('App\AmbitiousMailSender\CampaignEvents\CampaignEventRepository', 'CampaignEventRepository');
		$this->app->instance('App\AmbitiousMailSender\CampaignEvents\CampaignEventRepository', $this->campaignEventRepository);
		$this->campaignEventRepository->shouldReceive('setDomain')->with('gmail.com');

		// these are the parameters that we expect to get passed to the mocked repository
		$params = [
			'id'        => 'hyght',
			'event'     => 'clicked',
			'recipient' => null,
			'count'     => null
		];

		// create three events, this is what the mocked repo will return
		$event1Data = ['id' => 1, 'event' => 'clicked', 'recipient' => new Email('bobsmith@test.com')];
		$event2Data = ['id' => 2, 'event' => 'clicked', 'recipient' => new Email('jimjones@test.com')];
		$event3Data = ['id' => 3, 'event' => 'clicked', 'recipient' => new Email('aliceshaw@test.com')];

		$this->campaignEventRepository->shouldReceive('search')->with($params, 100, 0)->andReturn(Collection::make([
			new CampaignEvent($event1Data), new CampaignEvent($event2Data), new CampaignEvent($event3Data)
		]));

		// data that we're passing in for the request
		$urlData = [
			'campaignId' => 50,
			'offset'     => 0,
			'limit'      => 100,
			'event'      => 'clicked'
		];
		$this->action('GET', 'ApiV1\CampaignEventsController@show', $urlData);

		$this->assertResponseOk();

		// this is the final array that should be produced
		$campaignEventData = [
			['id' => 1, 'tags' => null, 'event' => 'clicked', 'recipient' => 'bobsmith@test.com', 'created_at' => null, 'updated_at' => null],
			['id' => 2, 'tags' => null, 'event' => 'clicked', 'recipient' => 'jimjones@test.com', 'created_at' => null, 'updated_at' => null],
			['id' => 3, 'tags' => null, 'event' => 'clicked', 'recipient' => 'aliceshaw@test.com', 'created_at' => null, 'updated_at' => null]
		];
		$this->assertViewHas('apiResponse', ['success' => 1, 'response' => $campaignEventData, 'message' => '']);
	}

}
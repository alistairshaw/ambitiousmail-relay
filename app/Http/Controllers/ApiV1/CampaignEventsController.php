<?php namespace App\Http\Controllers\ApiV1;

use App\AmbitiousMailSender\Campaigns\CampaignRepository;
use App\AmbitiousMailSender\CampaignStats\CampaignStatsRepository;
use Request;

class CampaignEventsController extends ApiController {

	/**
	 * @param int                      $campaignId
	 * @param CampaignEventsRepository $campaignEventsRepository
	 * @param CampaignRepository       $campaignRepository
	 */
	public function show($campaignId, CampaignEventsRepository $campaignEventsRepository, CampaignRepository $campaignRepository)
	{
		$campaign = $campaignRepository->find($campaignId);
		if (!$campaign) $this->failure('Invalid Campaign ID');

		// possible events to pass
		$availableEvents = ['clicks', 'opens', 'complaints', 'dropped', 'bounced'];
		$events = Request::get('events');

		if ($events && !in_array($events, $availableEvents)) $this->failure('Invalid parameter: events. Options are ' . implode(" | ", $availableEvents));
	}
}


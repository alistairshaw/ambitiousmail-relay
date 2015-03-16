<?php namespace App\Http\Controllers\ApiV1;

use App\AmbitiousMailSender\Campaigns\CampaignRepository;
use App\AmbitiousMailSender\CampaignEvents\CampaignEventRepository;
use Request;

class CampaignEventsController extends ApiController {

	/**
	 * @param int                     $campaignId
	 * @param CampaignEventRepository $campaignEventRepository
	 * @param CampaignRepository      $campaignRepository
	 */
	public function show($campaignId, CampaignEventRepository $campaignEventRepository, CampaignRepository $campaignRepository)
	{
		$campaign = $campaignRepository->find($campaignId);
		if ( ! $campaign) $this->failure('Invalid Campaign ID');

		// possible events to pass
		$availableEvents = ['clicked', 'opened', 'complained', 'bounced'];
		$event           = Request::get('event');

		if ($event && ! in_array($event, $availableEvents)) $this->failure('Invalid parameter: event. Options are ' . implode(" | ", $availableEvents));

		$offset = Request::get('offset', 0);
		$limit  = Request::get('limit', 100);

		$params['id'] = $campaign->remoteCampaignId();
		$params['event'] = $event;
		$params['recipient'] = Request::get('recipient', null);
		$params['count'] = Request::get('count', false);

		$campaignEventRepository->setDomain($campaign->getFromEmailDomain());
		$campaignStats = $campaignEventRepository->search($params, $limit, $offset);

		$final = [];
		foreach ($campaignStats as $entry)
		{
			$final[] = $entry->toArray();
		}

		$this->success($final);
	}
}
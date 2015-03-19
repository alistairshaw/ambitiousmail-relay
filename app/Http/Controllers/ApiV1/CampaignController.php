<?php namespace App\Http\Controllers\ApiV1;

use App\AmbitiousMailSender\Campaigns\CampaignFactory;
use App\AmbitiousMailSender\Campaigns\CampaignRepository;
use App\AmbitiousMailSender\CampaignStats\CampaignStatsRepository;
use Request;

class CampaignController extends ApiController {

	/**
	 * @param CampaignFactory    $campaignFactory
	 * @param CampaignRepository $campaignRepository
	 */
	public function store(CampaignFactory $campaignFactory, CampaignRepository $campaignRepository)
	{
		$campaign = $campaignFactory->create([
			'clientId'=>$this->client_id,
			'campaignName'=>Request::input('campaign_name'),
			'subjectLine'=>Request::input('subject_line'),
			'fromName'=>Request::input('from_name'),
			'trackOpens'=>Request::input('track_opens'),
			'trackClicks'=>Request::input('track_clicks'),
			'html'=>Request::input('html'),
			'plaintext'=>Request::input('plaintext'),
			'fromEmail'=>Request::input('from_email'),
			'replyToEmail'=>Request::input('reply_to_email'),
			'bounceEmail'=>Request::input('bounce_email')
		]);

		$campaignRepository->save($campaign);

		if (!$campaign) $this->failure('Unable to create new campaign');
		$this->success(['id'=>$campaign->id()]);
	}

	/**
	 * @param int                     $campaignId
	 * @param CampaignStatsRepository $campaignStatsRepository
	 * @param CampaignRepository      $campaignRepository
	 */
	public function show($campaignId, CampaignStatsRepository $campaignStatsRepository, CampaignRepository $campaignRepository)
	{
		$campaign = $campaignRepository->find($campaignId);
		if (!$campaign) $this->failure('Invalid Campaign ID');

		$campaignStatsRepository->setDomain($campaign->getFromEmailDomain());
		$campaignStats = $campaignStatsRepository->find($campaign->remoteCampaignId());

		$this->success($campaignStats->stats());
	}
}


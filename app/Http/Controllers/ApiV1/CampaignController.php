<?php namespace App\Http\Controllers\ApiV1;

use App\AmbitiousMailSender\Campaigns\CampaignFactory;
use App\AmbitiousMailSender\Campaigns\CampaignRepository;
use Request;

class CampaignController extends ApiController {

	/**
	 * @param CampaignFactory    $campaignFactory
	 * @param CampaignRepository $campaignRepository
	 */
	public function store(CampaignFactory $campaignFactory, CampaignRepository $campaignRepository)
	{
		$campaign = $campaignFactory->create([
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


}


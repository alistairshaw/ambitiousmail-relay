<?php namespace App\AmbitiousMailSender\Campaigns\Repository;

use App\AmbitiousMailSender\Campaigns\Campaign;
use App\AmbitiousMailSender\Campaigns\CampaignFactory;
use App\AmbitiousMailSender\Campaigns\CampaignRepository;
use App\AmbitiousMailSender\Base\Repository\AbstractEloquentRepository;
use App\AmbitiousMailSender\Campaigns\Gateway\EloquentCampaignModel;

class EloquentCampaignRepository extends AbstractEloquentRepository implements CampaignRepository {

	/**
	 * @var CampaignFactory
	 */
	protected $factory;

	/**
	 * @param EloquentCampaignModel   $model
	 * @param CampaignFactory $campaignFactory
	 */
	public function __construct(EloquentCampaignModel $model, CampaignFactory $campaignFactory)
	{
		$this->model = $model;
		$this->factory = $campaignFactory;
	}

	/**
	 * @param Campaign $campaign
	 * @return Campaign
	 */
	public function save($campaign)
	{
		$data = [
			'id'=>$campaign->id(),
			'client_id'=>$campaign->clientId(),
			'remote_campaign_id'=>$campaign->remoteCampaignId(),
			'campaign_name'=>$campaign->campaignName(),
			'subject_line'=>$campaign->subjectLine(),
			'from_name'=>$campaign->fromName(),
			'track_opens'=>$campaign->trackOpens(),
			'track_clicks'=>$campaign->trackClicks(),
			'html'=>$campaign->html(),
			'plaintext'=>$campaign->plaintext(),
			'from_email'=>$campaign->fromEmail(),
			'reply_to_email'=>$campaign->replyToEmail(),
			'bounce_email'=>$campaign->bounceEmail(),
			'domain'=>$campaign->domain(),
			'created_at'=>$campaign->createdAt(),
			'updated_at'=>$campaign->updatedAt()
		];
		return $this->saveEntity($campaign, $data);
	}
}
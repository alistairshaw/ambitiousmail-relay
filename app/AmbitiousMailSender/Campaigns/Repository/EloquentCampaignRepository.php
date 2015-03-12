<?php namespace App\AmbitiousMailSender\Campaigns\Repository;

use App\AmbitiousMailSender\Base\ValueObjects\DateTime;
use App\AmbitiousMailSender\Campaigns\Campaign;
use App\AmbitiousMailSender\Campaigns\CampaignFactory;
use App\AmbitiousMailSender\Campaigns\CampaignModel;
use App\AmbitiousMailSender\Campaigns\CampaignRepository;
use App\AmbitiousMailSender\Base\Repository\AbstractEloquentRepository;

class EloquentCampaignRepository extends AbstractEloquentRepository implements CampaignRepository {

	/**
	 * @var CampaignFactory
	 */
	protected $factory;

	/**
	 * @param CampaignModel   $model
	 * @param CampaignFactory $campaignFactory
	 */
	public function __construct(CampaignModel $model, CampaignFactory $campaignFactory)
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
			'campaign_name'=>$campaign->campaign_name(),
			'subject_line'=>$campaign->subject_line(),
			'from_name'=>$campaign->from_name(),
			'track_opens'=>$campaign->track_opens(),
			'track_clicks'=>$campaign->track_clicks(),
			'html'=>$campaign->html(),
			'plaintext'=>$campaign->plaintext(),
			'from_email'=>$campaign->from_email(),
			'reply_to_email'=>$campaign->reply_to_email(),
			'bounce_email'=>$campaign->bounce_email(),
			'created_at'=>$campaign->createdAt(),
			'updated_at'=>$campaign->updatedAt()
		];
		return $this->saveEntity($campaign, $data);
	}
}
<?php namespace App\AmbitiousMailSender\CampaignEmails\Repository;

use App\AmbitiousMailSender\CampaignEmails\CampaignEmail;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmailFactory;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository;
use App\AmbitiousMailSender\Base\Repository\AbstractEloquentRepository;
use App\AmbitiousMailSender\CampaignEmails\Gateway\EloquentCampaignEmailModel;
use Illuminate\Support\Collection;

class EloquentCampaignEmailRepository extends AbstractEloquentRepository implements CampaignEmailRepository {

	/**
	 * @var CampaignEmailFactory
	 */
	protected $factory;

	/**
	 * @param EloquentCampaignEmailModel   $model
	 * @param CampaignEmailFactory $campaignFactory
	 */
	public function __construct(EloquentCampaignEmailModel $model, CampaignEmailFactory $campaignFactory)
	{
		$this->model = $model;
		$this->factory = $campaignFactory;
	}

	/**
	 * @param CampaignEmail $campaignEmail
	 * @return CampaignEmail
	 */
	public function save($campaignEmail)
	{
		$data = [
			'id'=>$campaignEmail->id(),
			'campaign_id'=>$campaignEmail->campaignId(),
			'email_address'=>$campaignEmail->emailAddress(),
			'variables'=>json_encode($campaignEmail->variables()),
			'failed'=>$campaignEmail->failed(),
			'created_at'=>$campaignEmail->createdAt(),
			'updated_at'=>$campaignEmail->updatedAt()
		];
		return $this->saveEntity($campaignEmail, $data);
	}

}
<?php namespace App\Http\Controllers;

use App\AmbitiousMailSender\Base\ValueObjects\Email;
use App\AmbitiousMailSender\Campaigns\CampaignFactory;
use App\AmbitiousMailSender\Campaigns\CampaignRepository;

class CampaignController extends Controller {

	/**
	 * @var CampaignRepository
	 */
	private $campaignRepository;

	/**
	 * @var CampaignFactory
	 */
	private $campaignFactory;

	/**
	 * @param CampaignRepository $campaignRepository
	 */
	public function __construct(CampaignRepository $campaignRepository, CampaignFactory $campaignFactory)
	{
		$this->campaignRepository = $campaignRepository;
		$this->campaignFactory    = $campaignFactory;
	}

	/**
	 * @param CampaignRepository $campaignRepository
	 */
	public function index(CampaignRepository $campaignRepository)
	{
		$campaign = $this->campaignRepository->find(1);
	}

}

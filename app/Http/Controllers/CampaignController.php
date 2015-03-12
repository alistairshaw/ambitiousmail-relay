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
		$this->campaignFactory = $campaignFactory;
	}

	/**
	 * @param CampaignRepository $campaignRepository
	 */
	public function index(CampaignRepository $campaignRepository)
	{
		$factory = new CampaignFactory();
		$campaign = $factory->create([
			'campaign_name'=>'Test Campaign',
			'subject_line'=>'Subject Line',
			'from_name'=>'Alistair Shaw',
			'track_opens'=>true,
			'track_clicks'=>false,
			'html'=>'<p>This is my HTML message</p>',
			'plaintext'=>'This is my Plain Text message',
			'from_email'=>new Email('alistair@ambitiousdigital.co.uk')
		]);
		var_dump($campaign);
		$campaignRepository->save($campaign);

		/*$campaign = $campaignRepository->find(1);
		var_dump($campaign);
		$campaign->setCampaignName('Some Oldxx Name');
		var_dump($campaign);
		$campaignRepository->save($campaign);*/

	}

}

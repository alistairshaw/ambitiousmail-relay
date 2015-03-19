<?php namespace App\Http\Controllers\ApiV1;

use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;
use App\AmbitiousMailSender\Base\Services\WebHookReceiver\WebHookReceiver;
use App\AmbitiousMailSender\Base\Services\WebHookRelay\WebHookRelay;
use App\AmbitiousMailSender\Campaigns\CampaignRepository;
use App\AmbitiousMailSender\Clients\ClientRepository;
use App\Http\Controllers\Controller;
use Request;

class WebHooksController extends Controller {

	/**
	 * @param WebHookReceiver    $webHookReceiver
	 * @param WebHookRelay       $webHookRelay
	 * @param CampaignRepository $campaignRepository
	 * @param ClientRepository   $clientRepository
	 * @param HttpRequest        $httpRequest
	 */
	public function index(WebHookReceiver $webHookReceiver, WebHookRelay $webHookRelay, CampaignRepository $campaignRepository, ClientRepository $clientRepository, HttpRequest $httpRequest)
	{
		$vars = $webHookReceiver->receiveHook(Request::all());
		$campaign = $campaignRepository->findByDomain($vars['domain']);
		$client = $clientRepository->find($campaign->clientId());
		$webHookRelay->relay($vars, $client, $httpRequest);
	}

}
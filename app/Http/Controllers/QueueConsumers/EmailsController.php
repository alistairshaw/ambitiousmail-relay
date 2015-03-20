<?php namespace App\Http\Controllers\QueueConsumers;

use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;
use App\AmbitiousMailSender\Base\Services\MailTransport\MailTransport;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository;
use App\AmbitiousMailSender\Campaigns\CampaignRepository;
use Log;
use Request;

class EmailsController extends QueueConsumerController {

	/**
	 * @param HttpRequest             $httpRequest
	 * @param CampaignRepository      $campaignRepository
	 * @param CampaignEmailRepository $campaignEmailRepository
	 * @param MailTransport           $mailTransport
	 */
	function index(
		HttpRequest $httpRequest,
		CampaignRepository $campaignRepository,
		CampaignEmailRepository $campaignEmailRepository,
		MailTransport $mailTransport
	) {
		$message = Request::input('message');
		$msg     = json_decode($message);

		if (!$message)
		{
			// this is for debugging
			$campaignId = 17;
			$emailsToSend = 2;
		}
		else
		{
			$campaignId   = $msg->campaignId;
			$emailsToSend = $msg->emailsToSend;
		}

		Log::info('Email Sending Queue Consumer - Campaign: ' . $campaignId);

		if ($campaign = $campaignRepository->find($campaignId))
		{
			$searchParams = [
				'campaign_id'=>$campaignId,
				'failed'=>0
			];
			$emails = $campaignEmailRepository->search($searchParams, $emailsToSend);
			foreach ($emails as $email)
			{
				$success = $mailTransport->send($campaign, $email, $campaignRepository);
				if ($success)
				{
					$campaignEmailRepository->destroy($email->id());
				}
				else
				{
					$campaignEmailRepository->save($email->fail());
				}
			}
		}

		// create a new consumer to replace the one we just used
		$requestData = [
			'url'        => Route('queueConsumerEmailSend'),
			'queue_name' => 'AmbitiousMailSenderEmailSend'
		];
		$httpRequest->post(Route('queueConsumerSetup'), $requestData, 1, true, false);
	}

}
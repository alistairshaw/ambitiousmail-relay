<?php namespace App\Http\Controllers\QueueConsumers;

use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;
use App\AmbitiousMailSender\Base\Services\MailTransport\MailTransport;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmailFactory;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository;
use App\AmbitiousMailSender\Campaigns\CampaignFactory;
use App\AmbitiousMailSender\Campaigns\CampaignRepository;
use Request;

class EmailsController extends QueueConsumerController {

	/**
	 * @param HttpRequest             $httpRequest
	 * @param CampaignFactory         $campaignFactory
	 * @param CampaignRepository      $campaignRepository
	 * @param CampaignEmailFactory    $campaignEmailFactory
	 * @param CampaignEmailRepository $campaignEmailRepository
	 * @param MailTransport           $mailTransport
	 */
	function index(
		HttpRequest $httpRequest,
		CampaignFactory $campaignFactory,
		CampaignRepository $campaignRepository,
		CampaignEmailFactory $campaignEmailFactory,
		CampaignEmailRepository $campaignEmailRepository,
		MailTransport $mailTransport
	) {
		$message = Request::input('message');
		$msg     = json_decode($message);

		if (!$message)
		{
			$campaignId = 10;
			$emailsToSend = 5;
		}
		else
		{
			$campaignId   = $msg->campaignId;
			$emailsToSend = $msg->emailsToSend;
		}

		if ($campaign = $campaignRepository->find($campaignId))
		{
			$emails = $campaignEmailRepository->all($emailsToSend);
			foreach ($emails as $email)
			{
				$success = $mailTransport->send($campaign, $email);
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
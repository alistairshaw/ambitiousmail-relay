<?php namespace App\Http\Controllers\ApiV1;

use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;
use App\AmbitiousMailSender\Base\Services\Queue\Queue;
use App\AmbitiousMailSender\Base\ValueObjects\Email;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmailFactory;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository;
use Request;

class EmailsController extends ApiController {

	public function store(CampaignEmailFactory $campaignEmailFactory, CampaignEmailRepository $campaignEmailRepository, Queue $queue, HttpRequest $httpRequest)
	{
		$emails = json_decode(Request::input('emails'), true);
		$processed = 0;

		$campaignId = Request::input('campaign_id');

		foreach ($emails as $email)
		{
			$campaignEmail = $campaignEmailFactory->create([
				'campaignId'=>$campaignId,
				'emailAddress'=>new Email($email['email_address']),
				'variables'=>$email['variables']
			]);

			$campaignEmailRepository->save($campaignEmail);

			if (!$campaignEmail) $this->failure('Unable to add email');
			$processed++;
		}

		// add this campaign to the queue for sending
		$message = json_encode([
			'campaignId'=>$campaignId,
			'emailsToSend'=>$processed
		]);
		$queue->start('AmbitiousMailSenderEmailSend', $httpRequest);
		$queue->produce($message);

		$this->success(['received'=>$processed]);
	}


}


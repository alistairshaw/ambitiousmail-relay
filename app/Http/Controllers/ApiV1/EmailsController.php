<?php namespace App\Http\Controllers\ApiV1;

use App\AmbitiousMailSender\Base\Exceptions\InvalidArgumentException;
use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;
use App\AmbitiousMailSender\Base\Services\Queue\Queue;
use App\AmbitiousMailSender\Base\ValueObjects\Email;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmailFactory;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository;
use Request;

class EmailsController extends ApiController {

	public function store(CampaignEmailFactory $campaignEmailFactory, CampaignEmailRepository $campaignEmailRepository, Queue $queue, HttpRequest $httpRequest)
	{
		$emails    = json_decode(Request::input('emails'), true);
		$processed = 0;

		$campaignId = Request::input('campaign_id');

		foreach ($emails as $email)
		{
			try
			{
				$campaignEmail = $campaignEmailFactory->create([
					'campaignId'   => $campaignId,
					'emailAddress' => new Email($email['email_address']),
					'variables'    => $email['variables']
				]);
			}
			catch (InvalidArgumentException $e)
			{
				// if the email address is invalid, then
				//    we can just skip it
				continue;
			}

			$campaignEmailRepository->save($campaignEmail);
			$processed ++;
		}

		if ($processed > 0)
		{
			// add this campaign to the queue for sending
			$message = json_encode([
				'campaignId'   => $campaignId,
				'emailsToSend' => $processed
			]);
			$queue->start('AmbitiousMailSenderEmailSend', $httpRequest);
			$queue->produce($message);

		}

		return $this->success(['received' => $processed]);
	}


}


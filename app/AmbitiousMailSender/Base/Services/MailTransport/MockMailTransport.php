<?php namespace App\AmbitiousMailSender\Base\Services\MailTransport;

use App\AmbitiousMailSender\Base\Services\MailTransport\AbstractMailTransport;
use App\AmbitiousMailSender\Base\Services\MailTransport\MailTransport;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmail;
use App\AmbitiousMailSender\Campaigns\Campaign;
use App\AmbitiousMailSender\Campaigns\CampaignRepository;

class MockMailTransport extends AbstractMailTransport implements MailTransport {

	/**
	 * @param Campaign           $campaign
	 * @param CampaignEmail      $campaignEmail
	 * @param CampaignRepository $campaignRepository
	 * @return boolean
	 */
	public function send(Campaign $campaign, CampaignEmail $campaignEmail, CampaignRepository $campaignRepository = null)
	{
		$vars               = [];
		$vars['from']       = $campaign->fromName() . ' <' . $campaign->fromEmail() . '>';
		$vars['to']         = $this->getNameFromVariables($campaignEmail->variables()) . ' <' . $campaignEmail->emailAddress() . '>';
		$vars['subject']    = $this->insertVariables($campaign->subjectLine(), $campaignEmail->variables());
		$vars['text']       = $this->insertVariables($campaign->plaintext(), $campaignEmail->variables());
		$vars['html']       = $this->insertVariables($campaign->html(), $campaignEmail->variables());
		$vars['o:campaign'] = $campaign->remoteCampaignId();

		return true;
	}
}
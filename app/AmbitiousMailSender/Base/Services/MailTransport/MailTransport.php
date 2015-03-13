<?php namespace App\AmbitiousMailSender\Base\Services\MailTransport;

use App\AmbitiousMailSender\CampaignEmails\CampaignEmail;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmailFactory;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository;

interface MailTransport {

	public function send(CampaignEmail $campaignEmail, CampaignEmailFactory $campaignEmailFactory, CampaignEmailRepository $campaignEmailRepository);

}
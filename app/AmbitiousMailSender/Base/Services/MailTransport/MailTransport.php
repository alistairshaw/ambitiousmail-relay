<?php namespace App\AmbitiousMailSender\Base\Services\MailTransport;

use App\AmbitiousMailSender\CampaignEmails\CampaignEmail;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmailFactory;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository;
use App\AmbitiousMailSender\Campaigns\Campaign;
use App\AmbitiousMailSender\Campaigns\CampaignRepository;

interface MailTransport {

	public function send(Campaign $campaign, CampaignEmail $campaignEmail, CampaignRepository $campaignRepository);

}
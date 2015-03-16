<?php namespace App\AmbitiousMailSender\Base\Services\MailTransport;

use App\AmbitiousMailSender\CampaignEmails\CampaignEmail;
use App\AmbitiousMailSender\Campaigns\Campaign;
use App\AmbitiousMailSender\Campaigns\CampaignRepository;
use Config;
use Mailgun\Mailgun;

class MailgunMailTransport extends AbstractMailTransport implements MailTransport {

	/**
	 * yes or no
	 * @var string
	 */
	private $testMode = 'no';

	/**
	 * Mailgun key
	 * @var string
	 */
	private $key;

	public function __construct()
	{
		$this->key = Config::get('mailgun.key');
	}

	/**
	 * @param Campaign           $campaign
	 * @param CampaignEmail      $campaignEmail
	 * @param CampaignRepository $campaignRepository
	 * @return Campaign
	 * @throws \Mailgun\Messages\Exceptions\MissingRequiredMIMEParameters
	 */
	public function send(Campaign $campaign, CampaignEmail $campaignEmail, CampaignRepository $campaignRepository)
	{
		$mg     = new Mailgun($this->key);
		$domain = $campaign->getFromEmailDomain();

		if (!$campaign->remoteCampaignId()) $campaign = $this->setRemoteCampaignId($campaign, $mg, $domain, $campaignRepository);

		$vars               = [];
		$vars['from']       = $campaign->fromName() . ' <' . $campaign->fromEmail() . '>';
		$vars['to']         = $this->getNameFromVariables($campaignEmail->variables()) . ' <' . $campaignEmail->emailAddress() . '>';
		$vars['subject']    = $this->insertVariables($campaign->subjectLine(), $campaignEmail->variables());
		$vars['text']       = $this->insertVariables($campaign->plaintext(), $campaignEmail->variables());
		$vars['html']       = $this->insertVariables($campaign->html(), $campaignEmail->variables());
		$vars['o:campaign'] = $campaign->remoteCampaignId();
		$vars['o:testmode'] = $this->testMode;

		$result = $mg->sendMessage($domain, $vars);

		return $result;
	}

	/**
	 * @param Campaign $campaign
	 * @param Mailgun  $mg
	 * @param string   $domain
	 * @param          $campaignRepository
	 * @return string
	 */
	private function setRemoteCampaignId(Campaign $campaign, MailGun $mg, $domain, CampaignRepository $campaignRepository)
	{
		$params['name'] = $campaign->campaignName();
		$result = $mg->post($domain . '/campaigns', $params);

		$campaign->setRemoteCampaignId($result->http_response_body->campaign->id);
		$campaignRepository->save($campaign);

		return $campaign;
	}
}
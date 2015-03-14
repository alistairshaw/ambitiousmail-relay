<?php namespace App\AmbitiousMailSender\Base\Services\MailTransport;

use App;
use App\AmbitiousMailSender\CampaignEmails\CampaignEmail;
use App\AmbitiousMailSender\Campaigns\Campaign;
use Config;
use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_Message;

class SMTPMailTransport extends AbstractMailTransport implements MailTransport {

	/**
	 * @param Campaign      $campaign
	 * @param CampaignEmail $campaignEmail
	 * @return bool
	 */
	public function send(Campaign $campaign, CampaignEmail $campaignEmail)
	{
		$name = $this->getNameFromVariables($campaignEmail->variables());
		$html = $this->insertVariables($campaign->html(), $campaignEmail->variables());
		$plaintext = $this->insertVariables($campaign->plaintext(), $campaignEmail->variables());
		$subjectLine= $this->insertVariables($campaign->subjectLine(), $campaignEmail->variables());

		$message = Swift_Message::newInstance();
		$message->setTo(array($campaignEmail->emailAddress()=>$name));
		$message->setSubject($subjectLine);
		$message->setBody($plaintext, 'text/plain');
		$message->addPart($html, 'text/html');
		$message->setFrom(array($campaign->fromEmail()=>$campaign->fromName()));

		if ($campaign->replyToEmail()) $message->setReplyTo($campaign->replyToEmail());
		if ($campaign->bounceEmail()) $message->setReturnPath($campaign->bounceEmail());

		// Send the email
		$transport = Swift_SmtpTransport::newInstance(Config::get('mail.host'), Config::get('mail.port'));
		$transport->setUsername(Config::get('mail.username'));
		$transport->setPassword(Config::get('mail.password'));
		$mailer = Swift_Mailer::newInstance($transport);
		$result = $mailer->send($message);

		return (bool)$result;
	}
}
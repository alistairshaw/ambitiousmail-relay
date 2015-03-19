<?php namespace App\AmbitiousMailSender\Campaigns;

use App\AmbitiousMailSender\Base\Entity\AbstractEntity;
use App\AmbitiousMailSender\Base\Entity\Entity;
use App\AmbitiousMailSender\Base\ValueObjects\Email;

class Campaign extends AbstractEntity implements Entity {

	/**
	 * @var int
	 */
	protected $clientId;

	/**
	 * @var string
	 */
	protected $remoteCampaignId;

	/**
	 * @var string
	 */
	protected $campaignName;

	/**
	 * @var string
	 */
	protected $subjectLine;

	/**
	 * @var string
	 */
	protected $fromName;

	/**
	 * @var bool
	 */
	protected $trackOpens;

	/**
	 * @var bool
	 */
	protected $trackClicks;

	/**
	 * @var string
	 */
	protected $html;

	/**
	 * @var string
	 */
	protected $plaintext;

	/**
	 * @var Email
	 */
	protected $fromEmail;

	/**
	 * @var Email
	 */
	protected $replyToEmail;

	/**
	 * @var Email
	 */
	protected $bounceEmail;

	/**
	 * @var string
	 */
	protected $domain;

	/**
	 * @return int
	 */
	public function clientId()
	{
		return $this->clientId;
	}

	/**
	 * @param $id
	 */
	public function setRemoteCampaignId($id)
	{
		$this->remoteCampaignId = $id;
	}

	/**
	 * @return string
	 */
	public function remoteCampaignId()
	{
		return $this->remoteCampaignId;
	}

	/**
	 * @return string
	 */
	public function campaignName()
	{
		return $this->campaignName;
	}

	/**
	 * @return string
	 */
	public function subjectLine()
	{
		return $this->subjectLine;
	}

	/**
	 * @return string
	 */
	public function fromName()
	{
		return $this->fromName;
	}

	/**
	 * @return bool
	 */
	public function trackOpens()
	{
		return $this->trackOpens;
	}

	/**
	 * @return bool
	 */
	public function trackClicks()
	{
		return $this->trackClicks;
	}

	/**
	 * @return string
	 */
	public function html()
	{
		return $this->html;
	}

	/**
	 * @return string
	 */
	public function plaintext()
	{
		return $this->plaintext;
	}

	/**
	 * @return string
	 */
	public function fromEmail()
	{
		return $this->fromEmail->__toString();
	}

	/**
	 * @return string
	 */
	public function getFromEmailDomain()
	{
		return $this->fromEmail->getDomain();
	}

	/**
	 * @return string
	 */
	public function replyToEmail()
	{
		return $this->replyToEmail->__toString();;
	}

	/**
	 * @return string
	 */
	public function bounceEmail()
	{
		return $this->bounceEmail->__toString();;
	}

	/**
	 * @return string
	 */
	public function domain()
	{
		return $this->domain;
	}
}
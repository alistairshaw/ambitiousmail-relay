<?php namespace App\AmbitiousMailSender\CampaignEmails;

use App\AmbitiousMailSender\Base\Entity\AbstractEntity;
use App\AmbitiousMailSender\Base\Entity\Entity;
use App\AmbitiousMailSender\Base\ValueObjects\Email;

class CampaignEmail extends AbstractEntity implements Entity {

	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var int
	 */
	protected $campaignId;

	/**
	 * @var Email
	 */
	protected $emailAddress;

	/**
	 * @var array
	 */
	protected $variables;

	/**
	 * @var bool
	 */
	protected $failed = false;

	/**
	 * @return int
	 */
	public function id()
	{
		return $this->id;
	}

	/**
	 * @return int
	 */
	public function campaignId()
	{
		return $this->campaignId;
	}

	/**
	 * @param Email $emailAddress
	 */
	public function setEmailAddress(Email $emailAddress)
	{
		$this->emailAddress = $emailAddress;
	}

	/**
	 * @return string
	 */
	public function emailAddress()
	{
		if (!$this->emailAddress) return null;
		return $this->emailAddress->__toString();
	}

	/**
	 * @return string
	 */
	public function getEmailDomain()
	{
		return $this->emailAddress->getDomain();
	}

	/**
	 * @return mixed
	 */
	public function variables()
	{
		return $this->variables;
	}

	/**
	 * @param $varName
	 * @return null
	 */
	public function variable($varName)
	{
		return isset($this->variables[$varName]) ? $this->variables[$varName] : null;
	}

	/**
	 * @return CampaignEmail
	 */
	public function fail()
	{
		$this->failed = true;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function failed()
	{
		return $this->failed;
	}
}
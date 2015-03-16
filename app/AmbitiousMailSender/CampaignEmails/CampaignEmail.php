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
	 * @param $data
	 */
	public function __construct($data)
	{
		foreach ($data as $key => $value)
		{
			$this->setGeneric($key, $value);
			if ($key == 'variables' && !is_array($value))
			{
				$this->variables = json_decode($value);
			}
		}
	}

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
	 * @return string
	 */
	public function emailAddress()
	{
		return ($this->emailAddress) ? $this->emailAddress->__toString() : null;
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
<?php namespace App\AmbitiousMailSender\CampaignEmails;

use App\AmbitiousMailSender\Base\Entity\AbstractEntity;
use App\AmbitiousMailSender\Base\Entity\Entity;
use App\AmbitiousMailSender\Base\ValueObjects\Email;

class CampaignEmail extends AbstractEntity implements Entity {

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
	 * @param $data
	 */
	public function __construct($data)
	{
		foreach ($data as $key => $value)
		{
			$this->{$key} = $value;
			if ($key == 'variables' && !is_array($value))
			{
				$this->variables = json_decode($value);
			}
		}
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
		return $this->emailAddress->__toString();
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

}
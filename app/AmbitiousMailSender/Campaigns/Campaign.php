<?php namespace App\AmbitiousMailSender\Campaigns;

use App\AmbitiousMailSender\Base\Entity\AbstractEntity;
use App\AmbitiousMailSender\Base\Entity\Entity;
use App\AmbitiousMailSender\Base\ValueObjects\Email;

class Campaign extends AbstractEntity implements Entity {

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
	 * @param $data
	 */
	public function __construct($data)
	{
		foreach ($data as $key => $value)
		{
			switch ($key)
			{
				case 'trackOpens':
				case 'trackClicks':
					$this->{$key} = (bool)$value;
					break;
				default:
					$this->{$key} = $value;
			}
		}
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
		return $this->fromEmail;
	}

	/**
	 * @return string
	 */
	public function replyToEmail()
	{
		return $this->replyToEmail;
	}

	/**
	 * @return string
	 */
	public function bounceEmail()
	{
		return $this->bounceEmail;
	}
}
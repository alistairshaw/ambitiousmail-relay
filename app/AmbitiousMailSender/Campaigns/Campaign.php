<?php namespace App\AmbitiousMailSender\Campaigns;

use App\AmbitiousMailSender\Base\Entity\AbstractEntity;
use App\AmbitiousMailSender\Base\Entity\Entity;
use App\AmbitiousMailSender\Base\ValueObjects\Email;

class Campaign extends AbstractEntity implements Entity {

	/**
	 * @var string
	 */
	private $campaign_name;

	/**
	 * @var string
	 */
	private $subject_line;

	/**
	 * @var string
	 */
	private $from_name;

	/**
	 * @var bool
	 */
	private $track_opens;

	/**
	 * @var bool
	 */
	private $track_clicks;

	/**
	 * @var string
	 */
	private $html;

	/**
	 * @var string
	 */
	private $plaintext;

	/**
	 * @var Email
	 */
	private $from_email;

	/**
	 * @var Email
	 */
	private $reply_to_email;

	/**
	 * @var Email
	 */
	private $bounce_email;

	/**
	 * @param $data
	 */
	public function __construct($data)
	{
		foreach ($data as $key => $value)
		{
			switch ($key)
			{
				case 'track_opens':
				case 'track_clicks':
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
	public function campaign_name()
	{
		return $this->campaign_name;
	}

	/**
	 * @param $name
	 * @return $this
	 */
	public function setCampaignName($name)
	{
		$this->campaign_name = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function subject_line()
	{
		return $this->subject_line;
	}

	/**
	 * @return string
	 */
	public function from_name()
	{
		return $this->from_name;
	}

	/**
	 * @return bool
	 */
	public function track_opens()
	{
		return $this->track_opens;
	}

	/**
	 * @return bool
	 */
	public function track_clicks()
	{
		return $this->track_clicks;
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
	public function from_email()
	{
		return $this->from_email;
	}

	/**
	 * @return string
	 */
	public function reply_to_email()
	{
		return $this->reply_to_email;
	}

	/**
	 * @return string
	 */
	public function bounce_email()
	{
		return $this->bounce_email;
	}
}
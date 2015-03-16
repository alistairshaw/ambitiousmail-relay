<?php namespace App\AmbitiousMailSender\CampaignEvents;

use App\AmbitiousMailSender\Base\Entity\AbstractEntity;
use App\AmbitiousMailSender\Base\Entity\Entity;
use App\AmbitiousMailSender\Base\ValueObjects\Email;

class CampaignEvent extends AbstractEntity implements Entity {

	/**
	 * @var array
	 */
	protected $tags;

	/**
	 * @var string
	 */
	protected $event;

	/**
	 * @var Email
	 */
	protected $recipient;

	/**
	 * @param $data
	 */
	public function __construct($data)
	{
		foreach ($data as $key => $value)
		{
			$this->setGeneric($key, $value);
		}
	}

}
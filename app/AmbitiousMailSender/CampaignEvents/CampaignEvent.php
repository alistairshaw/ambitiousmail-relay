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
     * @var string
     */
    protected $link;

	/**
	 * @return array
	 */
	public function tags()
	{
		return $this->tags;
	}

	/**
	 * @return mixed
	 */
	public function event()
	{
		return $this->event;
	}

	/**
	 * @param Email $recipient
	 */
	public function setRecipient(Email $recipient)
	{
		$this->recipient = $recipient;
	}

	/**
	 * @return Email
	 */
	public function recipient()
	{
		return $this->recipient;
	}

}
<?php namespace App\AmbitiousMailSender\CampaignStats;

use App\AmbitiousMailSender\Base\Entity\AbstractEntity;
use App\AmbitiousMailSender\Base\Entity\Entity;

class CampaignStats extends AbstractEntity implements Entity {

	/**
	 * @var string
	 */
	protected $id;

	/**
	 * @var int
	 */
	protected $submitted;

	/**
	 * @var int
	 */
	protected $delivered;

	/**
	 * @var int
	 */
	protected $delivering;

	/**
	 * @var int
	 */
	protected $dropped;

	/**
	 * @var int
	 */
	protected $bounced;

	/**
	 * @var int
	 */
	protected $clicked;

	/**
	 * @var int
	 */
	protected $opened;

	/**
	 * @var int
	 */
	protected $complained;

	/**
	 * @param $data
	 */
	function __construct($data)
	{
		parent::__construct($data);
		$this->delivering = $this->submitted - $this->delivered - $this->dropped;
	}

	/**
	 * Get all stats data for this campaign
	 * @return array
	 */
	function stats()
	{
		$data['submitted'] = $this->submitted;
		$data['delivered'] = $this->delivered;
		$data['delivering'] = $this->delivering;
		$data['dropped'] = $this->dropped;
		$data['bounced'] = $this->bounced;
		$data['clicked'] = $this->clicked;
		$data['opened'] = $this->opened;
		$data['complained'] = $this->complained;

		return $data;
	}
}
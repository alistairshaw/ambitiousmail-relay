<?php namespace App\AmbitiousMailSender\Clients;

use App\AmbitiousMailSender\Base\Entity\AbstractEntity;
use App\AmbitiousMailSender\Base\Entity\Entity;

class Client extends AbstractEntity implements Entity {

	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $apiKey;

	/**
	 * @var string
	 */
	protected $webHookEndPoint;

	/**
	 * @return int
	 */
	public function id()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function name()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function apiKey()
	{
		return $this->apiKey;
	}

	/**
	 * @return string
	 */
	public function webHookEndPoint()
	{
		return $this->webHookEndPoint;
	}

}
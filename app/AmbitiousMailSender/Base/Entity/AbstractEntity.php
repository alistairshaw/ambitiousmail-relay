<?php namespace App\AmbitiousMailSender\Base\Entity;

use App\AmbitiousMailSender\Base\ValueObjects\DateTime;

class AbstractEntity implements Entity {

	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var DateTime
	 */
	protected $created_at;

	/**
	 * @var DateTime
	 */
	protected $updated_at;

	/**
	 * @return int
	 */
	public function id()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function createdAt()
	{
		return $this->created_at;
	}

	/**
	 * @param DateTime $createdAt
	 */
	public function setCreatedAt(DateTime $createdAt)
	{
		$this->created_at = $createdAt;
	}

	/**
	 * @return string
	 */
	public function updatedAt()
	{
		return $this->updated_at;
	}

	/**
	 * @param DateTime $updatedAt
	 */
	public function setUpdatedAt(DateTime $updatedAt)
	{
		$this->updated_at = $updatedAt;
	}

}
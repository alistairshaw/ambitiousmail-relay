<?php namespace App\AmbitiousMailSender\Base\Entity;

use App\AmbitiousMailSender\Base\ValueObjects\DateTime;
use ReflectionClass;
use ReflectionProperty;

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

	/**
	 * Returns array of all values from an entity
	 */
	public function toArray()
	{
		$final = array();
		$reflect = new ReflectionClass($this);
		$props   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);
		foreach ($props as $prop)
		{
			$propName = $prop->getName();
			$final[$propName] = $this->{$propName};
			if (is_object($this->{$propName})) $final[$propName] = $this->{$propName}->__toString();
		}
		return $final;
	}

}
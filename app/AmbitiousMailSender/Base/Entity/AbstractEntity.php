<?php namespace App\AmbitiousMailSender\Base\Entity;

use App\AmbitiousMailSender\Base\Exceptions\InvalidArgumentException;
use App\AmbitiousMailSender\Base\ValueObjects\DateTime;
use Exception;
use ReflectionClass;
use ReflectionProperty;

abstract class AbstractEntity implements Entity {

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
	 * @param $data
	 */
	public function __construct($data)
	{
		foreach ($data as $key => $value)
		{
			$this->__set($key, $value);
		}
	}

	/**
	 * Overload for shortcut writing
	 * @param $name
	 * @return mixed
	 * @throws Exception
	 */
	public function __get($name)
	{
		if (property_exists($this, $name) && method_exists($this, $name))
		{
			return $this->{$name}();
		}

		throw new InvalidArgumentException('Undefined property ' . $name);
	}

	/**
	 * If a setter exists, then it will call it. If the setter does not exist and the property is public
	 *    then it will just be set.
	 * @param string $name
	 * @param string $value
	 * @return mixed
	 * @throws Exception
	 */
	public function __set($name, $value)
	{
		$methodName = 'set' . ucwords($name);
		if (property_exists($this, $name) && method_exists($this, $methodName))
		{
			return $this->{$methodName}($value);
		}

		if (property_exists($this, $name))
		{
			return $this->{$name};
		}

		throw new InvalidArgumentException('Undefined property ' . $name);
	}

	/**
	 * @param $name
	 * @return bool
	 */
	public function __isset($name)
	{
		if (property_exists($this, $name) && method_exists($this, $name))
		{
			return true;
		}

		return false;
	}

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
		$final   = array();
		$reflect = new ReflectionClass($this);
		$props   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);
		foreach ($props as $prop)
		{
			$propName           = $prop->getName();
			$final[ $propName ] = $this->{$propName};
			if (is_object($this->{$propName})) $final[ $propName ] = $this->{$propName}->__toString();
		}

		return $final;
	}
}
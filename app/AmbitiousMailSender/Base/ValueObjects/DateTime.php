<?php namespace App\AmbitiousMailSender\Base\ValueObjects;

use App\AmbitiousMailSender\Base\Exceptions\InvalidArgumentException;
use PhpSpec\Exception\Exception;

class DateTime extends ValueObject {

	/**
	 * @var string
	 */
	private $dateTime;

	/**
	 * @var bool
	 */
	private $us_format = false;

	/**
	 * @param $timestamp
	 * @throws InvalidArgumentException
	 */
	public function __construct($timestamp)
	{
		if ($timestamp == '') throw new InvalidArgumentException('Invalid Date or Timestamp passed');
		if (!is_numeric($timestamp))
		{
			$timestamp = ($this->us_format) ? str_replace("-", "/", $timestamp) : str_replace("/", "-", $timestamp);
			$timestamp = strtotime($timestamp);
			if (!$timestamp) throw new InvalidArgumentException('Invalid Date or Timestamp passed');
		}

		$this->dateTime = date("Y-m-d H:i:s", $timestamp);
	}

	/**
	 * Return the mysql formatted dateTime
	 * @return bool|string
	 */
	public function __toString()
	{
		return $this->dateTime;
	}
}
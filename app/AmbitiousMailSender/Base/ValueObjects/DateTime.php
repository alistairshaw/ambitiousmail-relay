<?php namespace App\AmbitiousMailSender\Base\ValueObjects;

use PhpSpec\Exception\Exception;

class DateTime extends ValueObject {

	/**
	 * @var string
	 */
	private $dateTime;

	/**
	 * @param $timestamp
	 * @throws Exception
	 */
	public function __construct($timestamp)
	{
		if (!$this->_isValidTimeStamp($timestamp))
		{
			throw new Exception('Invalid Time Stamp passed');
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

	/**
	 * Check if a valid timestamp has been passed
	 * @param $timestamp
	 * @return bool
	 */
	private function _isValidTimeStamp($timestamp)
	{
		return !((string) (int) $timestamp === $timestamp)
		       && ($timestamp <= PHP_INT_MAX)
		       && ($timestamp >= ~PHP_INT_MAX);
	}

}
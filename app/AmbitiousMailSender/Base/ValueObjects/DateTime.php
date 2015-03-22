<?php namespace App\AmbitiousMailSender\Base\ValueObjects;

use App\AmbitiousMailSender\Base\Exceptions\InvalidArgumentException;

class DateTime extends ValueObject {

	/**
	 * @var string
	 */
	private $dateTime;

	/**
	 * @var int
	 */
	private $timeStamp;

	/**
	 * @var bool
	 */
	private $us_format = false;

	/**
	 * @param $timeStamp
	 * @throws InvalidArgumentException
	 */
	public function __construct($timeStamp)
	{
		if ($timeStamp == '') throw new InvalidArgumentException('Invalid Date or Timestamp passed');
		if (!is_numeric($timeStamp))
		{
			$timeStamp = ($this->us_format) ? str_replace("-", "/", $timeStamp) : str_replace("/", "-", $timeStamp);
			$timeStamp = strtotime($timeStamp);
			if (!$timeStamp) throw new InvalidArgumentException('Invalid Date or Timestamp passed');
		}

		$this->timeStamp = $timeStamp;
		$this->dateTime = date("Y-m-d H:i:s", $timeStamp);
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
	 * @param bool $returnTime
	 * @return string
	 */
	public function niceDate($returnTime = false)
	{
		$formatString = "jS M, Y";
		if ($returnTime) $formatString .= " g:ia";
		return date($formatString, $this->timeStamp);
	}
}
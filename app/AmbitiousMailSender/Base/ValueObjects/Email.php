<?php namespace App\AmbitiousMailSender\Base\ValueObjects;

use App\AmbitiousMailSender\Base\Exceptions\InvalidArgumentException;
use Exception;

class Email extends ValueObject {

	/**
	 * @var string
	 */
	private $email;

	/**
	 * @param $email
	 * @throws Exception
	 */
	public function __construct($email)
	{
		if ($email == '') throw new InvalidArgumentException('No Email Address Set');
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) throw new InvalidArgumentException('Invalid Email Address');
		$this->email = $email;
	}

	/**
	 * Gets only the domain part of the email address
	 * @return string
	 */
	public function getDomain()
	{
		return substr(strrchr($this->email, "@"), 1);
	}

	/**
	 * Return the mysql formatted dateTime
	 * @return bool|string
	 */
	public function __toString()
	{
		return $this->email;
	}

}
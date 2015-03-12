<?php namespace App\AmbitiousMailSender\Base\ValueObjects;

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
		if ($email !== '')
		{
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
			{
				throw new Exception('Invalid Email Address Passed');
			}
		}

		$this->email = $email;
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
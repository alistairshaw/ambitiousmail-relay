<?php namespace App\AmbitiousMailSender\Base\Services\HttpRequest;

abstract class AbstractHttpRequest implements HttpRequest {

	/**
	 * @var integer x
	 */
	protected $statusCode;

	/**
	 * @var string
	 */
	protected $username;

	/**
	 * @var string
	 */
	protected $password;

	/**
	 * @return integer
	 */
	public function statusCode()
	{
		return $this->statusCode;
	}

	/**
	 * @param $StatusCode
	 */
	protected function setStatusCode($StatusCode)
	{
		$this->statusCode = $StatusCode;
	}

	/**
	 * @param $username
	 * @param $password
	 * @return mixed
	 */
	public function setAuth($username, $password)
	{
		$this->username = $username;
		$this->password = $password;
	}

}
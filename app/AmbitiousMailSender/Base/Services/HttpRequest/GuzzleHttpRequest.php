<?php namespace App\AmbitiousMailSender\Base\Services\HttpRequest;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;

class GuzzleHttpRequest implements HttpRequest {

	/**
	 * @var integer x
	 */
	private $statusCode;

	/**
	 * @param string $url
	 * @param array  $data
	 * @param int    $timeout
	 * @param bool   $async
	 * @param bool   $returnResult
	 * @return mixed
	 */
	public function post($url, $data = array(), $timeout = 300, $async = false, $returnResult = true)
	{
		$client = new Client();

		$request = $client->post($url, [
			'body'    => $data,
			'future'  => $async,
			'timeout' => $timeout
		]);

		if ($returnResult)
		{
			$this->setStatusCode($request->getStatusCode());

			return $request->getBody();
		}

		return null;
	}

	/**
	 * @param string $url
	 * @param array  $data
	 * @param int    $timeout
	 * @param bool   $async
	 * @param bool   $returnResult
	 * @return mixed
	 */
	public function get($url, $data = array(), $timeout = 300, $async = false, $returnResult = true)
	{
		$client = new Client();

		$request = $client->get($url, [
			'params'  => $data,
			'future'  => $async,
			'timeout' => $timeout
		]);

		if ($returnResult)
		{
			$this->setStatusCode($request->getStatusCode());

			return $request->getBody();
		}

		return null;
	}

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
	private function setStatusCode($StatusCode)
	{
		$this->statusCode = $StatusCode;
	}
}
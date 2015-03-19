<?php namespace App\AmbitiousMailSender\Base\Services\HttpRequest;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;

class GuzzleHttpRequest extends AbstractHttpRequest implements HttpRequest {

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

		$requestOptions = [
			'body'    => $data,
			'future'  => $async,
			'timeout' => $timeout
		];

		if ($this->username && $this->password) $requestOptions['auth'] = [$this->username, $this->password];

		$request = $client->post($url, $requestOptions);

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

		$requestOptions = [
			'params'  => $data,
			'future'  => $async,
			'timeout' => $timeout
		];

		if ($this->username && $this->password) $requestOptions['auth'] = [$this->username, $this->password];

		$request = $client->get($url, $requestOptions);

		if ($returnResult)
		{
			$this->setStatusCode($request->getStatusCode());

			return $request->getBody();
		}

		return null;
	}
}
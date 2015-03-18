<?php namespace App\AmbitiousMailSender\Base\Services\HttpRequest;

class CurlHttpRequest implements HttpRequest {

	private $debugMode = false;

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
		return $this->_do_request($url, 'POST', $data);
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
		return $this->_do_request($url, 'GET');
	}

	/**
	 * @return integer
	 */
	public function statusCode()
	{
		return $this->statusCode();
	}

	/**
	 * Does the CURL request, returns the response or sets an error message
	 *
	 * @param  String $url Only pass the end of the URL, the main endpoint is set in the constructor
	 * @param  String $method
	 * @param  array $params Only pass in additional post parameters if required
	 *
	 * @return array
	 */
	private function _do_request($url, $method = 'GET', $params = array())
	{

		//Build the final URL
		$final_url = $url;

		// If debug mode is enabled then we print out the URL and parameters
		if ($this->debugMode)
		{
			var_dump($final_url);
			var_dump($params);
		}

		//Initiate CURL
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL            => $final_url,
			CURLOPT_HTTPGET        => 1
		));

		switch ($method)
		{
			case 'POST':
				curl_setopt_array($curl, array(
					CURLOPT_POSTFIELDS => $params
				));
				break;
			case 'PUT':
				curl_setopt($curl, CURLOPT_PUT, true);
				break;
			case 'DELETE':
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
				break;
			default:
				# code...
				break;
		}

		$resp = curl_exec($curl);

		$this->error_message = curl_error($curl);
		//Close Request
		curl_close($curl);
		$result = $resp;

		// If debug mode is enabled then we print out the CURL response
		if ($this->debugMode)
		{
			var_dump($result);
		}

		return $result;
	}
}
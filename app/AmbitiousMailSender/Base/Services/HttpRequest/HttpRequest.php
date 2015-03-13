<?php namespace App\AmbitiousMailSender\Base\Services\HttpRequest;

interface HttpRequest {

	/**
	 * @param string $url
	 * @param array  $data
	 * @param int    $timeout
	 * @param bool   $async
	 * @param bool   $returnResult
	 * @return mixed
	 */
	public function post($url, $data = array(), $timeout = 300, $async = false, $returnResult = true);

	/**
	 * @param string $url
	 * @param array  $data
	 * @param int    $timeout
	 * @param bool   $async
	 * @param bool   $returnResult
	 * @return mixed
	 */
	public function get($url, $data = array(), $timeout = 300, $async = false, $returnResult = true);

	/**
	 * @return integer
	 */
	public function statusCode();

}
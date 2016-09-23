<?php namespace App\Http\Controllers\ApiV1;

use App\AmbitiousMailSender\Clients\ClientRepository;
use App\Http\Controllers\Controller;
use Request;
use Response;

class ApiController extends Controller {

	/**
	 * @var integer
	 */
	protected $client_id;

	public function __construct(ClientRepository $clientRepository)
	{
		$username = Request::header('php-auth-user');
		$password = Request::header('php-auth-pw');

		$client = $clientRepository->findByName($username);
		if (!$client) abort(401, 'Permission Denied');

		if ($client->apiKey() !== $password) abort(401, 'Permission Denied');

		$this->client_id = $client->id();
	}

	/**
	 * @param string $response
	 * @param int    $response_code
	 * @return Response
	 */
	protected function failure($response, $response_code = 401)
	{
		http_response_code($response_code);
		$finalArray['success']  = 0;
		$finalArray['response'] = $response;

		return view('api-response', ['apiResponse'=>$finalArray]);
	}

	/**
	 * @param string $response
	 * @param string $message
	 * @param int    $response_code
	 * @return Response
	 */
	protected function success($response, $message = '', $response_code = 200)
	{
		http_response_code($response_code);
		$finalArray['success']  = 1;
		$finalArray['response'] = $response;
		$finalArray['message']  = $message;

		return view('api-response', ['apiResponse'=>$finalArray]);
	}
}
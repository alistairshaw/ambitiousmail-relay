<?php namespace App\Http\Controllers\ApiV1;

use App\AmbitiousMailSender\Clients\ClientRepository;
use App\Http\Controllers\Controller;
use Request;

class ApiController extends Controller {

	/**
	 * @var integer
	 */
	protected $client_id;

	public function __construct(ClientRepository $clientRepository)
	{
		$username = Request::header('php-auth-user');
		$password = Request::header('php-auth-pw');

		if (!$client = $clientRepository->findByName($username)) $this->failure('Permission Denied');
		if ($client->apiKey() !== $password) $this->failure('Permission Denied');

		$this->client_id = $client->id();
	}

	/**
	 * @param string $response
	 * @param int    $response_code
	 */
	protected function failure($response, $response_code = 401)
	{
		http_response_code($response_code);
		$final_array['success']  = 0;
		$final_array['response'] = $response;
		echo json_encode($final_array);
		exit();
	}

	/**
	 * @param string $response
	 * @param string $message
	 * @param int    $response_code
	 */
	protected function success($response, $message = '', $response_code = 200)
	{
		http_response_code($response_code);
		$final_array['success']  = 1;
		$final_array['response'] = $response;
		$final_array['message']  = $message;
		echo json_encode($final_array);
		exit();
	}
}
<?php namespace App\Http\Controllers;

use App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest;
use App\AmbitiousMailSender\Base\Services\Queue\RabbitMQQueue;
use Response;

class WelcomeController extends Controller {

	/**
	 * Create a new controller instance.
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}

}

<?php namespace App\Http\Controllers;

use App\AmbitiousMailSender\Base\ValueObjects\Email;
use App\AmbitiousMailSender\Campaigns\CampaignFactory;
use Illuminate\Http\Response;

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

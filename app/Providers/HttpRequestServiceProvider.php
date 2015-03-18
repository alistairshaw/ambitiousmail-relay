<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HttpRequestServiceProvider extends ServiceProvider {

	/**
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest',
			'App\AmbitiousMailSender\Base\Services\HttpRequest\CurlHttpRequest'
		);
	}

}
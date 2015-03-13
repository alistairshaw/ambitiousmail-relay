<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HttpRequestServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any repositories services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerHttpRequestInterface();
	}

	private function registerHttpRequestInterface()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest',
			'App\AmbitiousMailSender\Base\Services\HttpRequest\GuzzleHttpRequest'
		);
	}

}
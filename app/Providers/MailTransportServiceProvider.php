<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MailTransportServiceProvider extends ServiceProvider {

	/**
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\Base\Services\MailTransport\MailTransport',
			'App\AmbitiousMailSender\Base\Services\MailTransport\MailgunMailTransport'
		);
	}

}
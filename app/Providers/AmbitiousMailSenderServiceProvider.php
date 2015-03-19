<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AmbitiousMailSenderServiceProvider extends ServiceProvider {

	/**
	 * Register the repositories
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerHttpRequestServiceProvider();
		$this->registerMailTransportServiceProvider();
		$this->registerQueueServiceProvider();
		$this->registerWebHookReceiverServiceProvider();
		$this->registerWebHookRelayServiceProvider();
	}

	/**
	 * @return void
	 */
	public function registerHttpRequestServiceProvider()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\Base\Services\HttpRequest\HttpRequest',
			'App\AmbitiousMailSender\Base\Services\HttpRequest\GuzzleHttpRequest'
		);
	}

	/**
	 * @return void
	 */
	public function registerMailTransportServiceProvider()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\Base\Services\MailTransport\MailTransport',
			'App\AmbitiousMailSender\Base\Services\MailTransport\SMTPMailTransport'
		);
	}

	/**
	 * @return void
	 */
	public function registerQueueServiceProvider()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\Base\Services\Queue\Queue',
			'App\AmbitiousMailSender\Base\Services\Queue\RabbitMQQueue'
		);
	}

	/**
	 * @return void
	 */
	public function registerWebHookReceiverServiceProvider()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\Base\Services\WebHookReceiver\WebHookReceiver',
			'App\AmbitiousMailSender\Base\Services\WebHookReceiver\MailgunWebHookReceiver'
		);
	}

	/**
	 * @return void
	 */
	public function registerWebHookRelayServiceProvider()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\Base\Services\WebHookRelay\WebHookRelay',
			'App\AmbitiousMailSender\Base\Services\WebHookRelay\StandardWebHookRelay'
		);
	}
}
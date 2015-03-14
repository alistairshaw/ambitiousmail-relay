<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class QueueServiceProvider extends ServiceProvider {

	/**
	 * Register any repositories services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\Base\Services\Queue\Queue',
			'App\AmbitiousMailSender\Base\Services\Queue\RabbitMQQueue'
		);
	}

}
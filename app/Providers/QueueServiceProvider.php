<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class QueueServiceProvider extends ServiceProvider {

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
		$this->registerQueueInterface();
	}

	private function registerQueueInterface()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\Base\Services\Queue\Queue',
			'App\AmbitiousMailSender\Base\Services\Queue\RabbitMQQueue'
		);
	}

}
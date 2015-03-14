<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

	/**
	 * Register the repositories
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerCampaignRepository();
		$this->registerCampaignEmailRepository();
	}

	private function registerCampaignRepository()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\Campaigns\CampaignRepository',
			'App\AmbitiousMailSender\Campaigns\Repository\EloquentCampaignRepository'
		);
	}

	private function registerCampaignEmailRepository()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\CampaignEmails\CampaignEmailRepository',
			'App\AmbitiousMailSender\CampaignEmails\Repository\EloquentCampaignEmailRepository'
		);
	}

}
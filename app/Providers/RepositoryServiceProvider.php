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
		$this->registerCampaignStatsRepository();
		$this->registerCampaignEventRepository();
		$this->registerClientRepository();
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

	private function registerCampaignStatsRepository()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\CampaignStats\CampaignStatsRepository',
			'App\AmbitiousMailSender\CampaignStats\Repository\MailgunCampaignStatsRepository'
		);
	}

	private function registerCampaignEventRepository()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\CampaignEvents\CampaignEventRepository',
			'App\AmbitiousMailSender\CampaignEvents\Repository\MailgunCampaignEventRepository'
		);
	}

	private function registerClientRepository()
	{
		$this->app->bind(
			'App\AmbitiousMailSender\Clients\ClientRepository',
			'App\AmbitiousMailSender\Clients\Repository\EloquentClientRepository'
		);
	}
}
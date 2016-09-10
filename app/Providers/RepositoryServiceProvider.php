<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * @var string
     */
    private $mailService;

    /**
     * AmbitiousMailSenderServiceProvider constructor.
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct($app)
    {
        $this->mailService = env('MAIL_SERVICE', 'MOCK');
        parent::__construct($app);
    }

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
        switch ($this->mailService)
        {
            case 'MAILGUN':
                $bind = 'MailgunCampaignStatsRepository';
                break;
            case 'SMTP':
                $bind = 'SmtpCampaignStatsRepository';
                break;
            default:
                $bind = 'MockCampaignStatsRepository';
                break;
        }

		$this->app->bind(
			'App\AmbitiousMailSender\CampaignStats\CampaignStatsRepository',
			'App\AmbitiousMailSender\CampaignStats\Repository\\' . $bind
		);
	}

	private function registerCampaignEventRepository()
	{
        switch ($this->mailService)
        {
            case 'MAILGUN':
                $bind = 'MailgunCampaignEventRepository';
                break;
            case 'SMTP':
                $bind = 'SmtpCampaignEventRepository';
                break;
            default:
                $bind = 'MockCampaignEventRepository';
                break;
        }

		$this->app->bind(
			'App\AmbitiousMailSender\CampaignEvents\CampaignEventRepository',
			'App\AmbitiousMailSender\CampaignEvents\Repository\\' . $bind
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
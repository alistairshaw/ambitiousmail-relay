<?php namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class AmbitiousMailSenderServiceProvider extends ServiceProvider {

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
	    switch ($this->mailService)
        {
            case 'MAILGUN':
                $this->app->bind(
                    'App\AmbitiousMailSender\Base\Services\MailTransport\MailTransport',
                    'App\AmbitiousMailSender\Base\Services\MailTransport\MailgunMailTransport'
                );
                break;
            case 'SMTP':
                $this->app->bind(
                    'App\AmbitiousMailSender\Base\Services\MailTransport\MailTransport',
                    'App\AmbitiousMailSender\Base\Services\MailTransport\SMTPMailTransport'
                );
                break;
            default:
                $this->app->bind(
                    'App\AmbitiousMailSender\Base\Services\MailTransport\MailTransport',
                    'App\AmbitiousMailSender\Base\Services\MailTransport\MockMailTransport'
                );
                break;
        }
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
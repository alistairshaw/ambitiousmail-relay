<?php namespace App\AmbitiousMailSender\CampaignStats\Repository;

use App\AmbitiousMailSender\Base\ValueObjects\Collection;
use App\AmbitiousMailSender\CampaignStats\CampaignStats;
use App\AmbitiousMailSender\CampaignStats\CampaignStatsRepository;
use Config;
use Mailgun\Mailgun;

class MailgunCampaignStatsRepository implements CampaignStatsRepository {

	/**
	 * Mailgun key
	 * @var string
	 */
	private $key;

	/**
	 * @var string
	 */
	private $domain;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->key = Config::get('mailgun.key');
	}

	/**
	 * @param $domain
	 */
	public function setDomain($domain)
	{
		$this->domain = $domain;
	}

	/**
	 * @param int $id
	 * @return CampaignStats
	 */
	public function find($id)
	{
		$mg     = new Mailgun($this->key);
		$result = $mg->get($this->domain . '/campaigns/' . $id);

		$stats = $result->http_response_body;
		$data['clicked'] = $stats->clicked_count;
		$data['opened'] = $stats->opened_count;
		$data['submitted'] = $stats->submitted_count;
		$data['unsubscribed'] = $stats->unsubscribed_count;
		$data['bounced'] = $stats->bounced_count;
		$data['delivered'] = $stats->delivered_count;
		$data['complained'] = $stats->complained_count;
		$data['dropped'] = $stats->dropped_count;

		return new CampaignStats($data);
	}

	/**
	 * @param int $limit
	 * @param int $offset
	 * @return Collection
	 */
	public function all($limit = 0, $offset = 0)
	{
		// TODO: Implement all() method.
	}

	/**
	 * @param array $searchParams
	 * @param int   $limit
	 * @param int   $offset
	 * @return mixed
	 */
	public function search($searchParams, $limit = 0, $offset = 0)
	{
		// TODO: Implement search() method.
	}

	/**
	 * @param $entity
	 * @return mixed
	 */
	public function save($entity)
	{
		// TODO: Implement save() method.
	}

	/**
	 * @param int $limit
	 * @param int $offset
	 * @return mixed
	 */
	public function getSome($limit = 20, $offset = 0)
	{
		// TODO: Implement getSome() method.
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public function destroy($id)
	{
		// TODO: Implement destroy() method.
	}
}
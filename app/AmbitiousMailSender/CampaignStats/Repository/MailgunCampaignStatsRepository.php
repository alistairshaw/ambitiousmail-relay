<?php namespace App\AmbitiousMailSender\CampaignStats\Repository;

use App\AmbitiousMailSender\Base\Repository\AbstractMailgunRepository;
use App\AmbitiousMailSender\Base\ValueObjects\Collection;
use App\AmbitiousMailSender\CampaignStats\CampaignStats;
use App\AmbitiousMailSender\CampaignStats\CampaignStatsRepository;
use Config;
use Mailgun\Mailgun;

class MailgunCampaignStatsRepository extends AbstractMailgunRepository implements CampaignStatsRepository {

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
}
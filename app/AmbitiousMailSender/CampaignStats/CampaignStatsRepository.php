<?php namespace App\AmbitiousMailSender\CampaignStats;

use App\AmbitiousMailSender\Base\Repository\Repository;

interface CampaignStatsRepository extends Repository {

	/**
	 * @param int $id
	 * @return CampaignStats
	 */
	public function find($id);

	/**
	 * This is specific to mailgun
	 * @param $domain
	 */
	public function setDomain($domain);

}
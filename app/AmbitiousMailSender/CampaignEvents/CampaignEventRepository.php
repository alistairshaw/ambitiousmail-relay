<?php namespace App\AmbitiousMailSender\CampaignEvents;

use App\AmbitiousMailSender\Base\Repository\Repository;

interface CampaignEventRepository extends Repository {

	/**
	 * @param int $id
	 * @return CampaignEvent
	 */
	public function find($id);

	/**
	 * This is specific to mailgun
	 * @param $domain
	 */
	public function setDomain($domain);
}
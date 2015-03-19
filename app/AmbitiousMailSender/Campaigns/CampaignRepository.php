<?php namespace App\AmbitiousMailSender\Campaigns;

use App\AmbitiousMailSender\Base\Repository\Repository;

interface CampaignRepository extends Repository {

	/**
	 * @param int $id
	 * @return Campaign
	 */
	public function find($id);

	/**
	 * @param $domain
	 * @return Campaign
	 */
	public function findByDomain($domain);

}
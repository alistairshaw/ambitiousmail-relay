<?php namespace App\AmbitiousMailSender\CampaignEmails;

use App\AmbitiousMailSender\Base\Repository\Repository;

interface CampaignEmailRepository extends Repository {

	/**
	 * @param int $id
	 * @return CampaignEmail
	 */
	public function find($id);

}
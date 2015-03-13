<?php namespace App\AmbitiousMailSender\CampaignEmails;

use App\AmbitiousMailSender\Base\Entity\AbstractEntityFactory;
use App\AmbitiousMailSender\Base\Entity\EntityFactory;

class CampaignEmailFactory extends AbstractEntityFactory implements EntityFactory {

	/**
	 * @param array       $data
	 * @return CampaignEmail
	 */
	public function create($data = array())
	{
		$entity = parent::create($data);
		return $entity;
	}

	/**
	 * @param array $data
	 * @return CampaignEmail
	 */
	public function createEntity($data = array())
	{
		return new CampaignEmail($data);
	}

}
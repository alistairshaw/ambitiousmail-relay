<?php namespace App\AmbitiousMailSender\Campaigns;

use App\AmbitiousMailSender\Base\Entity\AbstractEntityFactory;
use App\AmbitiousMailSender\Base\Entity\EntityFactory;

class CampaignFactory extends AbstractEntityFactory implements EntityFactory {

	/**
	 * @param array       $data
	 * @return Campaign
	 */
	public function create($data = array())
	{
		$entity = parent::create($data);
		return $entity;
	}

	/**
	 * @param array $data
	 * @return Campaign
	 */
	public function createEntity($data = array())
	{
		return new Campaign($data);
	}

}
<?php namespace App\AmbitiousMailSender\CampaignStats;

use App\AmbitiousMailSender\Base\Entity\AbstractEntityFactory;
use App\AmbitiousMailSender\Base\Entity\EntityFactory;

class CampaignStatsFactory extends AbstractEntityFactory implements EntityFactory {

	/**
	 * @param array       $data
	 * @return CampaignStats
	 */
	public function create($data = array())
	{
		$entity = parent::create($data);
		return $entity;
	}

	/**
	 * @param array $data
	 * @return CampaignStats
	 */
	public function createEntity($data = array())
	{
		return new CampaignStats($data);
	}

}
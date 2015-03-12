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
		$this->entity = new Campaign($data);
		parent::create($data);
		return $this->entity;
	}

}
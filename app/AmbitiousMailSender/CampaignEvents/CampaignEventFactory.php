<?php namespace App\AmbitiousMailSender\CampaignEvents;

use App\AmbitiousMailSender\Base\Entity\AbstractEntityFactory;
use App\AmbitiousMailSender\Base\Entity\EntityFactory;
use App\AmbitiousMailSender\Base\ValueObjects\DateTime;
use App\AmbitiousMailSender\Base\ValueObjects\Email;

class CampaignEventFactory extends AbstractEntityFactory implements EntityFactory {

	/**
	 * @param array       $data
	 * @return CampaignEvent
	 */
	public function create($data = array())
	{
		$entity = parent::create($data);
		return $entity;
	}

	/**
	 * @param array $data
	 * @return CampaignEvent
	 */
	public function createEntity($data = array())
	{
		if (isset($data['recipient'])) $data['recipient'] = new Email($data['recipient']);
		if (isset($data['timestamp']))
		{
			$data['created_at'] = new DateTime(strtotime($data['timestamp']));
			$data['updated_at'] = new DateTime(strtotime($data['timestamp']));
		}
		return new CampaignEvent($data);
	}

}
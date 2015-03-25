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
		$final = [];
		if (isset($data['recipient'])) $final['recipient'] = new Email($data['recipient']);
		if (isset($data['timestamp']))
		{
			$final['created_at'] = new DateTime(strtotime($data['timestamp']));
			$final['updated_at'] = new DateTime(strtotime($data['timestamp']));
		}
		if (isset($data['event'])) $final['event'] = $data['event'];
		if (isset($data['tags'])) $final['tags'] = $data['tags'];
		return new CampaignEvent($final);
	}

}
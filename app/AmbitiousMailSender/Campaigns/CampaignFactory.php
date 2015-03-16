<?php namespace App\AmbitiousMailSender\Campaigns;

use App\AmbitiousMailSender\Base\Entity\AbstractEntityFactory;
use App\AmbitiousMailSender\Base\Entity\EntityFactory;
use App\AmbitiousMailSender\Base\ValueObjects\Email;

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
		if (isset($data['fromEmail'])) $data['fromEmail'] = new Email($data['fromEmail']);
		if (isset($data['from_email'])) $data['from_email'] = new Email($data['from_email']);
		if (isset($data['replyToEmail'])) $data['replyToEmail'] = new Email($data['replyToEmail']);
		if (isset($data['reply_to_email'])) $data['reply_to_email'] = new Email($data['reply_to_email']);
		if (isset($data['bounceEmail'])) $data['bounceEmail'] = new Email($data['bounceEmail']);
		if (isset($data['bounce_email'])) $data['bounce_email'] = new Email($data['bounce_email']);

		if (isset($data['trackOpens'])) $data['trackOpens'] = (bool)$data['trackOpens'];
		if (isset($data['track_opens'])) $data['track_opens'] = (bool)$data['track_opens'];
		if (isset($data['trackClicks'])) $data['trackClicks'] = (bool)$data['trackClicks'];
		if (isset($data['track_clicks'])) $data['track_clicks'] = (bool)$data['track_clicks'];
		return new Campaign($data);
	}

}
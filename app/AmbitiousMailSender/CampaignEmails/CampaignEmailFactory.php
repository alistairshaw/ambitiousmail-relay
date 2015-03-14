<?php namespace App\AmbitiousMailSender\CampaignEmails;

use App\AmbitiousMailSender\Base\Entity\AbstractEntityFactory;
use App\AmbitiousMailSender\Base\Entity\EntityFactory;
use App\AmbitiousMailSender\Base\ValueObjects\Email;

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
		if (isset($data['email_address']))
		{
			$data['emailAddress'] = New Email($data['email_address']);
			unset($data['email_address']);
		}
		return new CampaignEmail($data);
	}

}
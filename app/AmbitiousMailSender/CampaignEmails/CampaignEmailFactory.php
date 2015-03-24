<?php namespace App\AmbitiousMailSender\CampaignEmails;

use App\AmbitiousMailSender\Base\Entity\AbstractEntityFactory;
use App\AmbitiousMailSender\Base\Entity\EntityFactory;
use App\AmbitiousMailSender\Base\ValueObjects\DateTime;
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
		$final = [];
		foreach ($data as $key => $value)
		{
			$newKey = camel_case($key);

			// sort out dates
			if ($newKey == 'createdAt') $value = new DateTime($value);
			if ($newKey == 'updatedAt') $value = new DateTime($value);

			// sort out emails
			if ($newKey == 'emailAddress') $value = new Email($value);

			if ($newKey == 'variables')
			{
				if (!is_array($value)) $value = json_decode($value, true);
			}

			$final[ $newKey ] = $value;
		}

		return new CampaignEmail($final);
	}

}
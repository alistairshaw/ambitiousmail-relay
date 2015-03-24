<?php namespace App\AmbitiousMailSender\Campaigns;

use App\AmbitiousMailSender\Base\Entity\AbstractEntityFactory;
use App\AmbitiousMailSender\Base\Entity\EntityFactory;
use App\AmbitiousMailSender\Base\ValueObjects\Email;

class CampaignFactory extends AbstractEntityFactory implements EntityFactory {

	/**
	 * @param array $data
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
		$final = [];
		foreach ($data as $key => $value)
		{
			$newKey = camel_case($key);

			// sort out emails
			if ($newKey == 'fromEmail') $value = new Email($value);
			if ($newKey == 'replyToEmail')
			{
				if ($value)
				{
					$value = new Email($value);
				}
				else
				{
					continue;
				}
			}
			if ($newKey == 'bounceEmail')
			{
				if ($value)
				{
					$value = new Email($value);
				}
				else
				{
					continue;
				}
			}

			$final[ $newKey ] = $value;
		}

		return new Campaign($final);
	}

}
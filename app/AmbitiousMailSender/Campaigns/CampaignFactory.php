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
			$final[ camel_case($key) ] = $value;
		}

		// emails
		if (isset($final['fromEmail'])) $final['fromEmail'] = new Email($final['fromEmail']);

		if (isset($final['replyToEmail']))
		{
			if ($final['replyToEmail'] == '')
			{
				unset($final['replyToEmail']);
			}
			else
			{
				$final['replyToEmail'] = new Email($final['replyToEmail']);
			}
		}

		if (isset($final['bounceEmail']))
		{
			if ($final['bounceEmail'] == '')
			{
				unset($final['bounceEmail']);
			}
			else
			{
				$final['bounceEmail'] = new Email($final['bounceEmail']);
			}
		}

		return new Campaign($final);
	}

}
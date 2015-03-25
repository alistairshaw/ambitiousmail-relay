<?php namespace App\AmbitiousMailSender\Clients;

use App\AmbitiousMailSender\Base\Entity\AbstractEntityFactory;
use App\AmbitiousMailSender\Base\Entity\EntityFactory;
use App\AmbitiousMailSender\Base\ValueObjects\DateTime;
use App\AmbitiousMailSender\Base\ValueObjects\Email;

class ClientFactory extends AbstractEntityFactory implements EntityFactory {

	/**
	 * @param array       $data
	 * @return Client
	 */
	public function create($data = array())
	{
		$entity = parent::create($data);
		return $entity;
	}

	/**
	 * @param array $data
	 * @return Client
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

			$final[ $newKey ] = $value;
		}

		return new Client($final);
	}

}
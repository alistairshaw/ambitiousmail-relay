<?php namespace App\AmbitiousMailSender\Clients;

use App\AmbitiousMailSender\Base\Entity\AbstractEntityFactory;
use App\AmbitiousMailSender\Base\Entity\EntityFactory;
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
		// convert snake case to camel case
		$final = [];
		foreach ($data as $key => $value)
		{
			$final[ camel_case($key) ] = $value;
		}

		return new Client($final);
	}

}
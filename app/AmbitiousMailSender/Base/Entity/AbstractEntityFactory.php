<?php namespace App\AmbitiousMailSender\Base\Entity;

use App\AmbitiousMailSender\Base\ValueObjects\DateTime;

abstract class AbstractEntityFactory implements EntityFactory {

	/**
	 * Set the ID and timestamps
	 * @param array $data
	 * @return Entity
	 */
	public function create($data = array())
	{
		$entity = $this->createEntity($data);
		if (isset($data['id'])) $entity->setId($data['id']);

		if (isset($data['created_at']))
		{
			if (!is_int($data['created_at'])) $data['created_at'] = strtotime($data['created_at']);
			$entity->setCreatedAt(new DateTime($data['created_at']));
		}
		else
		{
			$entity->setCreatedAt(new DateTime(time()));
		}

		if (isset($data['updated_at']))
		{
			if (!is_int($data['updated_at'])) $data['updated_at'] = strtotime($data['updated_at']);
			$entity->setUpdatedAt(new DateTime($data['updated_at']));
		}
		else
		{
			$entity->setUpdatedAt(new DateTime(time()));
		}

		return $entity;
	}
}
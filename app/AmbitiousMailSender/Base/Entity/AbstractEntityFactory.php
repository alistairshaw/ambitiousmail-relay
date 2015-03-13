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

		$entity->setCreatedAt((isset($data['created_at'])) ? new DateTime($data['created_at']) : new DateTime(time()));
		$entity->setUpdatedAt((isset($data['updated_at'])) ? new DateTime($data['updated_at']) : new DateTime(time()));

		return $entity;
	}

}
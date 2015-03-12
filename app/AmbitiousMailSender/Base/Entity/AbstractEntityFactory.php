<?php namespace App\AmbitiousMailSender\Base\Entity;

use App\AmbitiousMailSender\Base\ValueObjects\DateTime;

class AbstractEntityFactory implements EntityFactory {

	/**
	 * @var Entity
	 */
	protected $entity;

	/**
	 * Set the ID and timestamps
	 * @param array $data
	 * @return Entity
	 */
	public function create($data = array())
	{
		if (isset($data['id'])) $this->entity->setId($data['id']);

		$this->entity->setCreatedAt((isset($data['created_at'])) ? new DateTime($data['created_at']) : new DateTime(time()));
		$this->entity->setUpdatedAt((isset($data['updated_at'])) ? new DateTime($data['updated_at']) : new DateTime(time()));

		return $this->entity;
	}

}
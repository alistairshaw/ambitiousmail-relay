<?php namespace App\AmbitiousMailSender\Base\Entity;

interface EntityFactory {

	/**
	 * @param array  $data
	 * @return Entity
	 */
	public function create($data = array());

	/**
	 * @param array $data
	 * @return mixed
	 */
	public function createEntity($data = array());

}
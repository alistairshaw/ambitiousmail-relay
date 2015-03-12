<?php namespace App\AmbitiousMailSender\Base\Entity;

interface EntityFactory {

	/**
	 * @param array  $data
	 * @return Entity
	 */
	public function create($data = array());

}
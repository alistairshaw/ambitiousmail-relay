<?php namespace App\AmbitiousMailSender\Base\Repository;

use App\AmbitiousMailSender\Base\Entity\Entity;
use App\AmbitiousMailSender\Base\ValueObjects\Collection;

interface Repository {

	/**
	 * @return Collection
	 */
	public function all();

	/**
	 * @param int $id
	 * @return Entity
	 */
	public function find($id);

	/**
	 * @param $entity
	 * @return mixed
	 */
	public function save($entity);

	/**
	 * @param int $id
	 * @return bool
	 */
	public function destroy($id);

}
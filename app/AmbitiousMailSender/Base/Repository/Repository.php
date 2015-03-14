<?php namespace App\AmbitiousMailSender\Base\Repository;

use App\AmbitiousMailSender\Base\Entity\Entity;
use App\AmbitiousMailSender\Base\ValueObjects\Collection;

interface Repository {

	/**
	 * @return Collection
	 */
	public function all($limit = 0, $offset = 0);

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
	 * @param int $limit
	 * @param int $offset
	 * @return mixed
	 */
	public function getSome($limit = 20, $offset = 0);

	/**
	 * @param int $id
	 * @return bool
	 */
	public function destroy($id);

}
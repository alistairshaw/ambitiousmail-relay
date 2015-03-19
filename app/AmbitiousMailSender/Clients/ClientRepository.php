<?php namespace App\AmbitiousMailSender\Clients;

use App\AmbitiousMailSender\Base\Repository\Repository;

interface ClientRepository extends Repository {

	/**
	 * @param int $id
	 * @return Client
	 */
	public function find($id);

	/**
	 * @param $username
	 * @return mixed
	 */
	public function findByName($username);

}
<?php namespace App\AmbitiousMailSender\Base\Repository;

use App\AmbitiousMailSender\Base\Entity\EntityFactory;
use Config;
use Illuminate\Support\Collection;

abstract class AbstractMailgunRepository {

	/**
	 * Mailgun key
	 * @var string
	 */
	protected $key;

	/**
	 * @var string
	 */
	protected $domain;

	/**
	 * @var EntityFactory
	 */
	protected $factory;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->key = Config::get('mailgun.key');
	}

	/**
	 * @param $domain
	 */
	public function setDomain($domain)
	{
		$this->domain = $domain;
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		return null;
	}

	/**
	 * @param int $limit
	 * @param int $offset
	 * @return Collection
	 */
	public function all($limit = 0, $offset = 0)
	{
		return null;
	}

	/**
	 * @param array $searchParams
	 * @param int   $limit
	 * @param int   $offset
	 * @return mixed
	 */
	public function search($searchParams, $limit = 0, $offset = 0)
	{
		return null;
	}

	/**
	 * @param $entity
	 * @return mixed
	 */
	public function save($entity)
	{
		return false;
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public function destroy($id)
	{
		// TODO: Implement destroy() method.
	}

}
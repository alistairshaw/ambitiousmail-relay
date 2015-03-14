<?php namespace App\AmbitiousMailSender\Base\Repository;

use App\AmbitiousMailSender\Base\Entity\Entity;
use App\AmbitiousMailSender\Base\Entity\EntityFactory;
use App\AmbitiousMailSender\Base\ValueObjects\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractEloquentRepository implements Repository {

	/**
	 * @var Model
	 */
	protected $model;

	/**
	 * @var EntityFactory
	 */
	protected $factory;

	/**
	 * @param int $limit
	 * @param int $offset
	 * @return Collection
	 */
	public function all($limit = 0, $offset = 0)
	{
		if ($limit == 0)
		{
			$results = $this->model->All();
		}
		else
		{
			$results = $this->model->take($limit)->skip($offset)->get();
		}

		$final = [];
		foreach ($results as $record)
		{
			$recordArray = $record->toArray();
			$final[] = $this->factory->create($recordArray);
		}

		return Collection::make($final);
	}

	/**
	 * @param int $limit
	 * @param int $offset
	 * @return mixed
	 */
	public function getSome($limit = 20, $offset = 0)
	{
		$results = $this->model->All();
		$final   = [];
		foreach ($results as $record)
		{
			$recordArray = $record->toArray();
			array_map(function ($value) { return preg_replace('/_(.?)/e', "strtoupper('$1')", $value); }, $recordArray);
			$final[] = $this->factory->create($recordArray);
		}

		return Collection::make($final);
	}

	/**
	 * @param int $id
	 * @return mixed
	 */
	public function find($id)
	{
		if ($record = $this->model->find($id))
		{
			$record = $record->toArray();
			if (isset($record['created_at'])) $record['created_at'] = strtotime($record['created_at']);
			if (isset($record['updated_at'])) $record['updated_at'] = strtotime($record['updated_at']);

			return $this->factory->create($record);
		}

		return null;
	}

	/**
	 * @param Entity $entity
	 * @param array  $data
	 * @return Entity
	 */
	public function saveEntity(Entity $entity, $data = array())
	{
		if ($entity->id())
		{
			if (isset($data['updated_at'])) $data['updated_at'] = date("Y-m-d H:i:s");
			$this->model->update($data);
		}
		else
		{
			$record = $this->model->create($data);
			$entity->setId($record->id);
		}

		return $entity;
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public function destroy($id)
	{
		return $this->model->destroy($id);
	}
}
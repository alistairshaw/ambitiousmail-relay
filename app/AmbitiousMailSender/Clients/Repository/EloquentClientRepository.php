<?php namespace App\AmbitiousMailSender\Clients\Repository;

use App\AmbitiousMailSender\Clients\Client;
use App\AmbitiousMailSender\Clients\ClientFactory;
use App\AmbitiousMailSender\Clients\ClientRepository;
use App\AmbitiousMailSender\Base\Repository\AbstractEloquentRepository;
use App\AmbitiousMailSender\Clients\Gateway\EloquentClientModel;

class EloquentClientRepository extends AbstractEloquentRepository implements ClientRepository {

	/**
	 * @var ClientFactory
	 */
	protected $factory;

	/**
	 * @param EloquentClientModel   $model
	 * @param ClientFactory $clientFactory
	 */
	public function __construct(EloquentClientModel $model, ClientFactory $clientFactory)
	{
		$this->model = $model;
		$this->factory = $clientFactory;
	}

	/**
	 * @param Client $client
	 * @return Client
	 */
	public function save($client)
	{
		$data = [
			'id'=>$client->id(),
			'name'=>$client->name(),
			'api_key'=>$client->apiKey(),
			'web_hook_end_point'=>$client->webHookEndPoint(),
			'created_at'=>$client->createdAt(),
			'updated_at'=>$client->updatedAt()
		];
		return $this->saveEntity($client, $data);
	}

	/**
	 * @param $domain
	 * @return Client
	 */
	public function getByDomain($domain)
	{
		$client = $this->model->hasDomain($domain)->first();
		return $this->factory->create($client->toArray());
	}
}
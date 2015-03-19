<?php namespace App\AmbitiousMailSender\Clients\Gateway;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class EloquentClientModel extends Model {

	protected $table = 'clients';

	protected $fillable = ['name', 'api_key', 'web_hook_end_point', 'created_at', 'updated_at'];

	/**
	 * @param $domain
	 * @return mixed
	 */
	public function scopeHasDomain($query, $domain)
	{
		return $query->whereDomain($domain);
	}

}
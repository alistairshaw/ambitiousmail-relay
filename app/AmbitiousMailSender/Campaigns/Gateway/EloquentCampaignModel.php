<?php namespace App\AmbitiousMailSender\Campaigns\Gateway;

use Illuminate\Database\Eloquent\Model;

class EloquentCampaignModel extends Model {

	protected $table = 'campaigns';

	protected $fillable = ['client_id', 'remote_campaign_id', 'campaign_name', 'subject_line', 'from_name', 'track_opens', 'track_clicks', 'html', 'plaintext', 'from_email', 'reply_to_email', 'bounce_email', 'domain', 'created_at', 'updated_at'];

	/**
	 * @param $query
	 * @param $domain
	 */
	public function scopeDomain($query, $domain)
	{
		return $query->whereDomain($domain);
	}
}
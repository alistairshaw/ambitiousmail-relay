<?php namespace App\AmbitiousMailSender\CampaignEmails\Gateway;

use Illuminate\Database\Eloquent\Model;

class EloquentCampaignEmailModel extends Model {

	protected $table = 'emails';

	protected $fillable = ['campaign_id', 'email_address', 'variables', 'created_at', 'updated_at'];

}
<?php namespace App\AmbitiousMailSender\Campaigns;

use Illuminate\Database\Eloquent\Model;

class CampaignModel extends Model {

	protected $table = 'campaigns';

	protected $fillable = ['campaign_name', 'subject_line', 'from_name', 'track_opens', 'track_clicks', 'html', 'plaintext', 'from_email', 'reply_to_email', 'bounce_email', 'created_at', 'updated_at'];

}
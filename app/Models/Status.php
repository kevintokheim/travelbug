<?php

namespace travelbug\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
	protected $table = 'statuses';
	
	protected $fillable = ['body'];
	
	//Connects a user to a status or statuses
	public function user()
	{
		return $this->belongsTo('travelbug\Models\User', 'user_id');
	}
}

<?php namespace tutostube;

use Illuminate\Database\Eloquent\Model;

class userBan extends Model {

	protected $table = 'user_ban';

	protected $fillable = ['id_user',
						   'id_reason'];

}

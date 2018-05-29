<?php namespace tutostube;

use Illuminate\Database\Eloquent\Model;

class follow extends Model {

	protected $table = 'follow';

	protected $fillable = ['id_follower',
						   'id_followed'];

}

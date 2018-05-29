<?php namespace tutostube;

use Illuminate\Database\Eloquent\Model;

class favorite extends Model {

	protected $table = 'favorite';

	protected $fillable = ['id_video',
						   'id_user'];
}

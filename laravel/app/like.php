<?php namespace tutostube;

use Illuminate\Database\Eloquent\Model;

class like extends Model {

	protected $table = 'like';

	protected $fillable = ['id_video',
						   'id_user'];

}

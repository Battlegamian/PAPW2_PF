<?php namespace tutostube;

use Illuminate\Database\Eloquent\Model;

class comment extends Model {

	protected $table = 'comments';

	protected $fillable = ['id_user', 
						   'id_video', 
						   'comment', 
						   'date'];

}

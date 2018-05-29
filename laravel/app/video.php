<?php namespace tutostube;

use Illuminate\Database\Eloquent\Model;

class video extends Model {

	protected $table = 'video';

	protected $fillable = ['id_user',
						   'id_type',
						   'name',
						   'description',
						   'url',
						   'views',
						   'photo',
						   'date',
						   'active'];

}

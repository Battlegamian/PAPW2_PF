<?php namespace tutostube;

use Illuminate\Database\Eloquent\Model;

class user extends Model {

	protected $table = 'user';

	protected $fillable = ['name', 
						   'last_name', 
						   'email', 
						   'password', 
						   'birth_date',
						   'photo_profile',
						   'photo_background',
						   'type',
						   'active'];

}

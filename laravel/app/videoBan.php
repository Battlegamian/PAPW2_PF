<?php namespace tutostube;

use Illuminate\Database\Eloquent\Model;

class videoBan extends Model {

	protected $table = 'video_ban';

	protected $fillable = ['id_video',
						   'id_reason'];

}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// DB::table('user')->insert(
		// 	['name' => 'Samuel',
		// 	 'last_name' => 'Sosa',
		// 	 'email' => 'zamuelzoza@hotmail.com',
		// 	 'password' => '1234',
		// 	 'birth_date' => '1998/08/21',
		// 	 'photo_profile' => null,
		// 	 'photo_background' => null,
		// 	 'type' => '1',
		// 	 'active' => '1']
		// );

		// DB::table('video_type')->insert(
		// 	[
		// 		'type' => 'Cartón'
		// 	],
		// 	[
		// 		'type' => 'Tela'
		// 	],
		// 	[
		// 		'type' => 'Madera'
		// 	],
		// 	[
		// 		'type' => 'Plástico'
		// 	],
		// 	[
		// 		'type' => 'Metal'
		// 	],
		// 	[
		// 		'type' => 'Cosplay'
		// 	]
		// );


		// Model::unguard();

		// $this->call('UserTableSeeder');
	}

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
	public function run()
	{
		$faker = Faker::create();
		$num = 100;

		for ($i = 0; $i <= 50; $i++) {
			DB::table('brands')->insert([
				'brand_code' => $num + $i++,
				'brand_name' => $faker->company,
			]);
		}
	}
}

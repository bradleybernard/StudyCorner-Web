<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	foreach (range(1,10) as $index) {
	        DB::table('study_sessions')->insert([
	            'title' => $faker->name,
	            'class_id' => $faker->randomDigit,
	            'location' => $faker->name,
	            'owner_id' => $faker->randomDigit,
	            'latitude' => $faker->randomFloat,
	            'longitude' => $faker->randomFloat,
	            'details' => $faker->name,
	            'time_start' => $faker->dateTime,
	            'time_end' => $faker->dateTime,
	            'status' => $faker->randomDigit,
	            'class_id' => $faker->randomDigit,
	            'location' => $faker->name,
	            'created_at' => $faker->dateTime,
	            'updated_at' => $faker->dateTime
	        ]);
        }
    }
}


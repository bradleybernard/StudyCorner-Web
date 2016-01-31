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
	            'title' => $faker->word,
	            'class_id' => $faker->randomDigit,
	            'location' => $faker->word,
	            'owner_id' => $faker->randomDigit,
	            'latitude' => $faker->latitude,
	            'longitude' => $faker->longitude,
	            'details' => $faker->text($maxNbChars = 20),
	            'time_start' => $faker->dateTime,
	            'time_end' => $faker->dateTime,
	            'status' => $faker->numberBetween($min = 0, $max = 1),
	            'location' => $faker->city,
	            'created_at' => $faker->dateTime,
	            'updated_at' => $faker->dateTime
	        ]);
        }
    }
}


<?php

use Illuminate\Database\Seeder;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('films')->insert([
                'name' => 'Mission Impossible',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.',
                'release_date' => '2017-06-03',
                'country' => 'USA',
                'price' => 37.45,
                'photo' => 'img.jpg'
        ]);
        DB::table('films')->insert([
                'name' => 'Jumanji',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.',
                'release_date' => '2017-06-03',
                'country' => 'USA',
                'price' => 37.45,
                'photo' => 'img.jpg'
        ]);
    }
}

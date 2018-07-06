<?php

use App\User;
use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder {
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (User::where('id', 1)->exists()) {
            $user_id = 1;
        } else{
            DB::table('users')->insert([
                    'name' => 'Rahmani Saif El Moulouk',
                    'email' => 'cool2309@gmail.com',
                    'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', //secret
                    'remember_token' => str_random(10),
            ]);
            $user_id = 1;
        }
        
        DB::table('ratings')->insert([
                'user_id' => $user_id,
                'film_id' => 1,
                'rating' => 3,
        ]);
        DB::table('ratings')->insert([
                'user_id' => $user_id,
                'film_id' => 1,
                'rating' => 5,
        ]);
        DB::table('ratings')->insert([
                'user_id' => $user_id,
                'film_id' => 2,
                'rating' => 5,
        ]);
    }
}

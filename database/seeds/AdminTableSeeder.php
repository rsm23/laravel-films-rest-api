<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create([
                'name' => 'Super Admin',
                'email' => 'cool2309@gmail.com',
                'remember_token' => str_random(10),
                'isAdmin' => true
        ]);
    }
}

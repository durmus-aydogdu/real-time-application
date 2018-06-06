<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();

        for($i = 1; $i<=100; $i++)
        {
            $value = str_random(6);

            $user = User::updateOrCreate(
                ['name' => $value, 'email' => $value.'@test.com'],
                ['password' => bcrypt('123456'), 'remember_token' => str_random(100)]
            );
        }
    }
}

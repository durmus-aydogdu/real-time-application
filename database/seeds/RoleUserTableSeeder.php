<?php

use App\User;
use App\Role;
use App\RoleUser;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i<=20; $i++)
        {
            $userId = User::inRandomOrder()->value('id');

            $roleId = Role::inRandomOrder()->value('id');

            RoleUser::updateOrCreate(['user_id' => $userId, 'role_id' => $roleId]);
        }
    }
}

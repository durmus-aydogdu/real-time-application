<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(['name' => 'Software engineer']);
        Role::updateOrCreate(['name' => 'Systems analyst']);
        Role::updateOrCreate(['name' => 'Business analyst']);
        Role::updateOrCreate(['name' => 'Technical support']);
        Role::updateOrCreate(['name' => 'Network engineer']);
    }
}

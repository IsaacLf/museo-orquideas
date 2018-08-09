<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'papitrunks@gmail.com',
            'password'=> Hash::make('123456'),
            'name' => 'Victor',
            'last_name' => 'Lopez',
            'profile' => 'administrator'
        ]);
        DB::table('users')->insert([
            'username' => 'isaaclf',
            'email' => '5389@itescam.edu.mx',
            'password'=> Hash::make('123456'),
            'name' => 'Isaac',
            'last_name' => 'Lf',
            'profile' => 'editor'
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name'=>'admin@test.loc',
                'password'=>Hash::make('password'),
                'email'=>'admin@test.loc'
            ]
        );
        factory(User::class, 15)->create();
    }
}

<?php

use App\UserSection;
use Illuminate\Database\Seeder;

class UsersSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserSection::class, 10)->create();
    }
}

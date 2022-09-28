<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "fabio";
        $user->email = "fubal.scricchiolo20@gmail.com";
        $user->password = bcrypt("Fabietto20");
        $user->save();
    }
}

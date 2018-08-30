<?php

use Illuminate\Database\Seeder;
use App\User;

class adduser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<12;$i++) {
        $user=new User;

        $user->name=str_random(10);

        $user->email=str_random(10).'@gmail.com';
        $user->password=bcrypt('12121212');
        $user->address=str_random(10);
        $user->phone=str_random(10);
        $user->lever='1';

        $user->save();
            }
    }
}

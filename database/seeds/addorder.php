<?php

use Illuminate\Database\Seeder;
use App\Order;
class addorder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<3;$i++) {
        $user         =new Order();
        $user->total  ='20000';
        $user->status ='1';
        $user->user_id='2';
        $user->save();
        }
        for ($i=0;$i<3;$i++) {
            $user=new Order();
            $user->total='20000';
            $user->status='0';
            $user->user_id='3';
            $user->save();
        }
        for ($i=0;$i<3;$i++) {
            $user=new Order();
            $user->total='20000';
            $user->status='3';
            $user->user_id='4';
            $user->save();
        }
        for ($i=0;$i<3;$i++) {
            $user=new Order();
            $user->total='20000';
            $user->status='4';
            $user->user_id='5';
            $user->save();
        }
    }
}

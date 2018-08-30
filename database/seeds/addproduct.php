<?php

use Illuminate\Database\Seeder;
use App\Product;

class addproduct extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 4; $i++){
            $user = new Product();

        $user->name = str_random(10);
        $user->price = '12354';
        $user->image = str_random(10) . 'jpg';
        $user->size = str_random(3);
        $user->color = str_random(10);
        $user->category_id = 4;
        $user->save();
    }
        for ($i=0;$i<4;$i++) {
            $user = new Product();

            $user->name = str_random(10);
            $user->price = '12354';
            $user->image = str_random(10) . 'jpg';
            $user->size = str_random(3);
            $user->color = str_random(10);
            $user->category_id = 3;
            $user->save();
        }

    }
}

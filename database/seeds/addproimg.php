<?php

use Illuminate\Database\Seeder;
use App\Productimage;
class addproimg extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<4;$i++) {
        $cate=new Productimage();

        $cate->name=str_random(10);
        $cate->product_id='2';
        $cate->save();
            }
        for ($i=0;$i<4;$i++) {
            $cate=new Productimage();

            $cate->name=str_random(10);
            $cate->product_id='3';
            $cate->save();
        }
        for ($i=0;$i<4;$i++) {
            $cate=new Productimage();

            $cate->name=str_random(10);
            $cate->product_id='4';
            $cate->save();
        }
    }
}

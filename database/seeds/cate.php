<?php

use Illuminate\Database\Seeder;
use App\Category;

class cate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          for ($i=0;$i<14;$i++){
            $cate=new Category();

            $cate->name=str_random(10);

            $cate->save();
          }

    }
}

<?php

use Illuminate\Database\Seeder;

class Posts extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        factory(App\Models\Posts::class, 100)->state('image')->create();
        factory(App\Models\Posts::class, 100)->state('text')->create();
    }
}

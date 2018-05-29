<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET foreign_key_checks=0');
        Category::truncate();
        factory(Category::class, 10)->create();
        DB::statement('SET foreign_key_checks=1');
    }
}

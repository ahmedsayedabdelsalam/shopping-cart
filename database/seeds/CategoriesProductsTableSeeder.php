<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;
use Carbon\Carbon;


class CategoriesProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET foreign_key_checks=0');
        DB::table('category_product')->truncate();

        for($i=0; $i<40; $i++) {
            DB::table('category_product')->insert([
                "category_id" => Category::get()->random()->id,
                "product_id" => Product::get()->random()->id,
                "created_at" => Carbon::now()->subHours(rand(0, 9999)),  
                "updated_at" => Carbon::now()->subHours(rand(0, 9999))  
            ]);
        }

        DB::statement('SET foreign_key_checks=1');
    }
}

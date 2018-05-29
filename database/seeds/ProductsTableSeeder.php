<?php

use Illuminate\Database\Seeder;

use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Product::truncate();
        DB::statement("SET foreign_key_checks=1");
        factory(Product::class, 20)->create();
    }
}

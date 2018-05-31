<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Product;
use App\Family;

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

        $dir = storage_path('app/public/product_images');
        $leave_files = ['default.jpg'];
        foreach( glob("$dir/*") as $file ) {
            if( !in_array(basename($file), $leave_files) )
                unlink($file);
        }

        DB::statement("SET foreign_key_checks=1");
        factory(Product::class, 20)->create();
    }
}

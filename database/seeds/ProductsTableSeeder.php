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
        $product = new Product([
            'imagePath' => 'http://placehold.it/100x80/080',
            'title' => 'title 1',
            'description' => 'this is description one',
            'price' => 35
        ]);
        $product->save();
        $product = new Product([
            'imagePath' => 'http://placehold.it/100x80/fff',
            'title' => 'title 2',
            'description' => 'this is description two',
            'price' => 70
        ]);
        $product->save();
        $product = new Product([
            'imagePath' => 'http://placehold.it/100x80/333',
            'title' => 'title 3',
            'description' => 'this is description three',
            'price' => 10
        ]);
        $product->save();
        $product = new Product([
            'imagePath' => 'http://placehold.it/100x80/ccc',
            'title' => 'title 4',
            'description' => 'this is description four',
            'price' => 90
        ]);
        $product->save();
        $product = new Product([
            'imagePath' => 'http://placehold.it/100x80/aaa',
            'title' => 'title 5',
            'description' => 'this is description five',
            'price' => 60
        ]);
        $product->save();
    }
}

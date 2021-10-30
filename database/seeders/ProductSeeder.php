<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'product_name' => 'Adidas',
                'price'=> 100000,
            
            ],
            [
                'product_name' => 'Compass',
                'price'=> 500000,
            ],
        ];

        foreach ($data as $key => $value) {
            Product::create($value);
        }
    }
}

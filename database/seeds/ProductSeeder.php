<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Sample Product 1',
                'price' => 100.00,
                'vat_included' => true,
                'vat_rate' => 21.00,
            ],
            [
                'name' => 'Sample Product 2',
                'price' => 125.00,
                'vat_included' => false,
                'vat_rate' => 21.00,
            ],
            [
                'name' => 'Sample Product 3',
                'price' => 75.00,
                'vat_included' => false,
                'vat_rate' => 18.00,
            ],
            [
                'name' => 'Sample Product 4',
                'price' => 59.90,
                'vat_included' => true,
                'vat_rate' => 8,
            ],
        ];

        collect($products)->each(function ($product) {
           \App\Product::create($product);
        });
    }
}

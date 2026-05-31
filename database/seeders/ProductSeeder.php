<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Piłka nożna Adidas',
            'description' => 'Profesjonalna piłka meczowa, rozmiar 5.',
            'price' => 129.99,
            'stock' => 15,
        ]);

        Product::create([
            'name' => 'Rakieta tenisowa Wilson',
            'description' => 'Lekka rakieta idealna dla osób średniozaawansowanych.',
            'price' => 349.00,
            'stock' => 8,
        ]);

        Product::create([
            'name' => 'Mata do jogi HMS',
            'description' => 'Antypoślizgowa mata o grubości 6mm, kolor czarny.',
            'price' => 79.50,
            'stock' => 25,
        ]);

        Product::create([
            'name' => 'Rower górski Scott',
            'description' => 'Aluminiowa rama, koła 29 cali, osprzęt Shimano.',
            'price' => 2899.00,
            'stock' => 3,
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::truncate();

        Menu::create([
            'name' => 'Nasi Goreng ',
            'type' => 'makanan',
            'price' => 25000,
            'image' => 'images/menu/nasi-goreng.jpg',
        ]);

        Menu::create([
            'name' => 'Sate Ayam',
            'type' => 'makanan',
            'price' => 30000,
            'image' => 'images/menu/sate-ayam.jpg',
        ]);

        Menu::create([
            'name' => 'Rahang Tuna Bakar',
            'type' => 'makanan',
            'price' => 40000,
            'image' => 'images/menu/rahang-tuna.jpeg',
        ]);

        Menu::create([
            'name' => 'Tinutuan',
            'type' => 'makanan',
            'price' => 15000,
            'image' => 'images/menu/tinutuan.webp',
        ]);

        Menu::create([
            'name' => 'Es teh',
            'type' => 'minuman',
            'price' => 5000,
            'image' => 'images/menu/esteh.png',
        ]);

        Menu::create([
            'name' => 'Jus Jeruk',
            'type' => 'minuman',
            'price' => 10000,
            'image' => 'images/menu/esjeruk.png',
        ]);

        Menu::create([
            'name' => 'Jus Alpukat',
            'type' => 'minuman',
            'price' => 15000,
            'image' => 'images/menu/jusalpukat.png',
        ]);

        Menu::create([
            'name' => 'Es Kopi',
            'type' => 'minuman',
            'price' => 7000,
            'image' => 'images/menu/jus-alpukat.jpg',
        ]);
    }
}

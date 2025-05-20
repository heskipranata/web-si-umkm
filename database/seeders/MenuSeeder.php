<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::truncate();

        $menus = [
            [
                'name'  => 'Nasi Goreng',
                'type'  => 'makanan',
                'price' => 25000,
                'image' => 'images/menu/nasi-goreng.jpg', // gambar lokal
            ],
            [
                'name'  => 'Nasi Ragey',
                'type'  => 'makanan',
                'price' => 25000,
                'image' => 'https://lh3.googleusercontent.com/p/AF1QipPv4BZ4C0iXAzOfUGu47h2fuI8KswusYkQ9RLd2=w215-h280-p-k-no', // gambar lokal
            ],
            [
                'name'  => 'Sate Ragey',
                'type'  => 'makanan',
                'price' => 44000,
                'image' => 'https://lh3.googleusercontent.com/p/AF1QipM1YaXsLpbUExOCfq1ryEtlF-6WhAd-sxMkgfaG=w215-h280-p-k-no', // gambar lokal
            ],
            [
                'name'  => 'Mie Ayam',
                'type'  => 'makanan',
                'price' => 25000,
                'image' => 'https://images.unsplash.com/photo-1569924220711-b1648079a75b?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // gambar lokal
            ],
            [
                'name'  => 'Bakso Komplit',
                'type'  => 'makanan',
                'price' => 30000,
                'image' => 'https://images.unsplash.com/photo-1687425973269-af0d62587769?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YmFrc298ZW58MHx8MHx8fDA%3D', // gambar lokal
            ],
            [
                'name'  => 'Mie Goreng',
                'type'  => 'makanan',
                'price' => 25000,
                'image' => 'https://images.unsplash.com/photo-1612929633738-8fe44f7ec841?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8bWllJTIwZ29yZW5nfGVufDB8fDB8fHww', // gambar lokal
            ],
            [
                'name'  => 'Ayam Geprek',
                'type'  => 'makanan',
                'price' => 15000,
                'image' => 'https://images.unsplash.com/photo-1696340034876-6245523babfa?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YXlhbSUyMGdlcHJla3xlbnwwfHwwfHx8MA%3D%3D', // gambar lokal
            ],
            [
                'name'  => 'Nasi Komplit',
                'type'  => 'makanan',
                'price' => 25000,
                'image' => 'https://images.unsplash.com/photo-1712565043059-cd19ff8394cb?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bWFrYW5hbiUyMGluZG9uZXNpYXxlbnwwfHwwfHx8MA%3D%3D', // gambar lokal
            ],
            [
                'name'  => 'Rahang Tuna Bakar',
                'type'  => 'makanan',
                'price' => 40000,
                'image' => 'images/menu/rahang-tuna.jpeg', // link gambar online
            ],
            [
                'name'  => 'Tinutuan',
                'type'  => 'makanan',
                'price' => 15000,
                'image' => 'images/menu/tinutuan.webp', // gambar lokal
            ],
            [
                'name'  => 'Bakwan',
                'type'  => 'makanan',
                'price' => 1000,
                'image' => 'https://asset.kompas.com/crops/tjE6gtN0K5LbaL5MhLRt3OKoa6A=/177x95:977x628/750x500/data/photo/2023/03/31/64264d601dca5.jpg', // gambar lokal
            ],
            [
                'name'  => 'Tahu Isi',
                'type'  => 'makanan',
                'price' => 1000,
                'image' => 'https://cdn0-production-images-kly.akamaized.net/J28wjWQnIG-CtGC92qLsWhWCbYU=/1360x766/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/4281785/original/003405600_1672849832-shutterstock_2132515083.jpg', // gambar lokal
            ],
            [
                'name'  => 'Es Teh',
                'type'  => 'minuman',
                'price' => 5000,
                'image' => 'https://nilaigizi.com/assets/images/produk/produk_1578041377.jpg', // link gambar online
            ],
            [
                'name'  => 'Jus Jeruk',
                'type'  => 'minuman',
                'price' => 10000,
                'image' => 'images/menu/esjeruk.png', // gambar lokal
            ],
            [
                'name'  => 'Jus Alpukat',
                'type'  => 'minuman',
                'price' => 15000,
                'image' => 'images/menu/jusalpukat.png', // link gambar online
            ],
            [
                'name'  => 'Es Nutrisari',
                'type'  => 'minuman',
                'price' => 5000,
                'image' => 'https://img-global.cpcdn.com/recipes/c2790f7f2c04a4c9/1280x1280sq70/photo.webp', // gambar lokal
            ],
            [
                'name'  => 'Air Mineral',
                'type'  => 'minuman',
                'price' => 5000,
                'image' => 'https://ik.imagekit.io/dcjlghyytp1/300adff901b6c9a2cc17e6a51c1e6893?tr=f-auto,w-1000', // gambar lokal
            ],
            [
                'name'  => 'Jus Semangka',
                'type'  => 'minuman',
                'price' => 5000,
                'image' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//99/MTA-21218769/no_brand_jus_semangka_300ml_promo_gosend_grab_bandung_full01_n4k1v5zp.jpg', // gambar lokal
            ],
            [
                'name'  => 'Jus Sirsak',
                'type'  => 'minuman',
                'price' => 5000,
                'image' => 'https://cdn.yummy.co.id/content-images/images/20220614/aeIKxPnmQPXjFEThnlBHM8o934Vvwx9G-31363535313936393131d41d8cd98f00b204e9800998ecf8427e.jpg?x-oss-process=image/resize,w_388,h_388,m_fixed,x-oss-process=image/format,webp', // gambar lokal
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}

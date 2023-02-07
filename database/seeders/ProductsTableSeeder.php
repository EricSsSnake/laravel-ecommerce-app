<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 30; $i++) {
            Product::create([
                'name' => 'Laptop ' . $i,
                'slug' => 'laptop-' . $i,
                'details' => [12, 13.5, 15, 15.5, 17][array_rand([12, 13.5, 15, 15.5, 17])] . ' inch, ' . [1, 2, 3, 4][array_rand([1, 2, 3, 4])] . 'TB SSD, ' . [8, 12, 16, 24, 32][array_rand([8, 12, 16, 24, 32])] . ' GB RAM',
                'price' => ['249999', '349999', '149999'][array_rand(['249999', '349999', '149999'])],
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia impedit non numquam, alias fuga perferendis. Quasi eaque dolore distinctio asperiores expedita ipsum deserunt, totam, optio sit repellendus, molestias dignissimos officiis cupiditate architecto. Repellat aut rerum maxime recusandae? Dignissimos officiis et molestiae sint ad hic optio, obcaecati nisi tempore quo. Voluptatum nesciunt ducimus modi fugit sint ea fugiat placeat et perspiciatis ex, ipsam quo quae, natus amet velit consequuntur optio deleniti, libero perferendis facilis repudiandae provident?',
            ])->categories()->attach(1);
        }

        $product = Product::find(1);
        $product->categories()->attach(2);

        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Desktop ' . $i,
                'slug' => 'desktop-' . $i,
                'details' => [21, 21.5, 23.5, 24, 25, 27][array_rand([21, 21.5, 23.5, 24, 25, 27])] . ' inch, ' . [1, 2, 3, 4][array_rand([1, 2, 3, 4])] . 'TB SSD, ' . [8, 12, 16, 24, 32, 64][array_rand([8, 12, 16, 24, 32, 64])] . ' GB RAM',
                'price' => [249999, 349999, 449999][array_rand([249999, 349999, 449999])],
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia impedit non numquam, alias fuga perferendis. Quasi eaque dolore distinctio asperiores expedita ipsum deserunt, totam, optio sit repellendus, molestias dignissimos officiis cupiditate architecto. Repellat aut rerum maxime recusandae? Dignissimos officiis et molestiae sint ad hic optio, obcaecati nisi tempore quo. Voluptatum nesciunt ducimus modi fugit sint ea fugiat placeat et perspiciatis ex, ipsam quo quae, natus amet velit consequuntur optio deleniti, libero perferendis facilis repudiandae provident?',
            ])->categories()->attach(2);
        }

        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Phone ' . $i,
                'slug' => 'phone-' . $i,
                'details' => [7, .5, 8, 8.5, 6.5][array_rand([7, .5, 8, 8.5, 6.5])] . ' inch screen, ' . [12, 16, 24, 32, 64, 128, 256, 512][array_rand([12, 16, 24, 32, 64, 128, 256, 512])] . 'GB, ' . [8, 12, 16, 24, 32, 64][array_rand([8, 12, 16, 24, 32, 64])] . ' GB RAM',
                'price' => [79999, 119999, 149999, 169999][array_rand([79999, 119999, 149999, 169999])],
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia impedit non numquam, alias fuga perferendis. Quasi eaque dolore distinctio asperiores expedita ipsum deserunt, totam, optio sit repellendus, molestias dignissimos officiis cupiditate architecto. Repellat aut rerum maxime recusandae? Dignissimos officiis et molestiae sint ad hic optio, obcaecati nisi tempore quo. Voluptatum nesciunt ducimus modi fugit sint ea fugiat placeat et perspiciatis ex, ipsam quo quae, natus amet velit consequuntur optio deleniti, libero perferendis facilis repudiandae provident?',
            ])->categories()->attach(3);
        }

        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Tablet ' . $i,
                'slug' => 'tablet-' . $i,
                'details' => [10, 12, 14, 15.5, 17][array_rand([10, 12, 14, 15.5, 17])] . ' inch screen, ' . [12, 16, 24, 32, 64, 128, 256, 512][array_rand([12, 16, 24, 32, 64, 128, 256, 512])] . 'GB, ' . [8, 12, 16, 24, 32, 64][array_rand([8, 12, 16, 24, 32, 64])] . ' GB RAM',
                'price' => [79999, 119999, 149999, 169999][array_rand([79999, 119999, 149999, 169999])],
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia impedit non numquam, alias fuga perferendis. Quasi eaque dolore distinctio asperiores expedita ipsum deserunt, totam, optio sit repellendus, molestias dignissimos officiis cupiditate architecto. Repellat aut rerum maxime recusandae? Dignissimos officiis et molestiae sint ad hic optio, obcaecati nisi tempore quo. Voluptatum nesciunt ducimus modi fugit sint ea fugiat placeat et perspiciatis ex, ipsam quo quae, natus amet velit consequuntur optio deleniti, libero perferendis facilis repudiandae provident?',
            ])->categories()->attach(4);
        }

        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'TV ' . $i,
                'slug' => 'tv-' . $i,
                'details' => [46, 50, 60, 72][array_rand([46, 50, 60, 72])] . ' inch screen, smart TV, 4k',
                'price' => [249999, 349999, 449999][array_rand([249999, 349999, 449999])],
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia impedit non numquam, alias fuga perferendis. Quasi eaque dolore distinctio asperiores expedita ipsum deserunt, totam, optio sit repellendus, molestias dignissimos officiis cupiditate architecto. Repellat aut rerum maxime recusandae? Dignissimos officiis et molestiae sint ad hic optio, obcaecati nisi tempore quo. Voluptatum nesciunt ducimus modi fugit sint ea fugiat placeat et perspiciatis ex, ipsam quo quae, natus amet velit consequuntur optio deleniti, libero perferendis facilis repudiandae provident?',
            ])->categories()->attach(5);
        }

        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Camera ' . $i,
                'slug' => 'camera-' . $i,
                'details' => 'Full Frame DSLR, with 18-55mm kit lens',
                'price' => [79999, 129999][array_rand([79999, 129999])],
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia impedit non numquam, alias fuga perferendis. Quasi eaque dolore distinctio asperiores expedita ipsum deserunt, totam, optio sit repellendus, molestias dignissimos officiis cupiditate architecto. Repellat aut rerum maxime recusandae? Dignissimos officiis et molestiae sint ad hic optio, obcaecati nisi tempore quo. Voluptatum nesciunt ducimus modi fugit sint ea fugiat placeat et perspiciatis ex, ipsam quo quae, natus amet velit consequuntur optio deleniti, libero perferendis facilis repudiandae provident?',
            ])->categories()->attach(6);
        }

        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Appliance ' . $i,
                'slug' => 'appliance-' . $i,
                'details' => 'lorem Quasi eaque dolore distinctio asperiores',
                'price' => [79999, 129999][array_rand([79999, 129999])],
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia impedit non numquam, alias fuga perferendis. Quasi eaque dolore distinctio asperiores expedita ipsum deserunt, totam, optio sit repellendus, molestias dignissimos officiis cupiditate architecto. Repellat aut rerum maxime recusandae? Dignissimos officiis et molestiae sint ad hic optio, obcaecati nisi tempore quo. Voluptatum nesciunt ducimus modi fugit sint ea fugiat placeat et perspiciatis ex, ipsam quo quae, natus amet velit consequuntur optio deleniti, libero perferendis facilis repudiandae provident?',
            ])->categories()->attach(7);
        }
    }
}

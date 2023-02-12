<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code' => 'abc123',
            'type' => 'fixed',
            'value' => 20000
            //value is in cents
        ]);

        Coupon::create([
            'code' => 'abc456',
            'type' => 'percent',
            'percent_off' => 50
        ]);
    }
}

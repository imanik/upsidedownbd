<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            'code'          => 'c5',
            'discount'      => 5,
            'branch_id'     => 1,
            'start_date'    => Carbon::now()->startOfMonth(),
            'end_date'      => Carbon::now()->endOfMonth(),
        ]);

        DB::table('coupons')->insert([
            'code'          => 'c10',
            'discount'      => 10,
            'branch_id'     => 1,
            'start_date'    => Carbon::now()->startOfMonth(),
            'end_date'      => Carbon::now()->endOfMonth(),
        ]);

        DB::table('coupons')->insert([
            'code'          => 'c15',
            'discount'      => 15,
            'branch_id'     => 1,
            'start_date'    => Carbon::now()->startOfMonth(),
            'end_date'      => Carbon::now()->endOfMonth(),
        ]);

        DB::table('coupons')->insert([
            'code'          => 'c20',
            'discount'      => 20,
            'branch_id'     => 1,
            'start_date'    => Carbon::now()->startOfMonth(),
            'end_date'      => Carbon::now()->endOfMonth(),
        ]);
    }
}

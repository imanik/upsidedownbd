<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert([
            'name'          => 'Dhanmondi',
            'mobile'        => '01615710070',
            'address'       => 'House 2/6, Block #C, Lalmatia, Dhaka 1207',
            'status'        => 'active',
            'regular_price' => 400,
            'child_price'   => 250,
        ]);
        DB::table('branches')->insert([
            'name'          => 'Uttara',
            'mobile'        => '01881288281',
            'address'       => 'House 29, 5th Floor, Garib E Newaz Ave Sector 13#, Uttara, Dhaka',
            'status'        => 'active',
            'regular_price' => 400,
            'child_price'   => 250,
        ]);
    }
}

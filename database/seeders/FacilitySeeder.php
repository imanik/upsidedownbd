<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facilities')->insert([
            'title'     => 'DSLR - 50 photos',
            'cost'      => '300',
            'branch_id' => '1',
        ]);
        DB::table('facilities')->insert([
            'title'     => 'DSLR - 100 photos',
            'cost'      => '500',
            'branch_id' => '1',
        ]);
        DB::table('facilities')->insert([
            'title'     => 'DSLR - 50 photos',
            'cost'      => '300',
            'branch_id' => '2',
        ]);
        DB::table('facilities')->insert([
            'title'     => 'DSLR - 100 photos',
            'cost'      => '500',
            'branch_id' => '2',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('bundles')->insert([
            'title'                 => 'Advanced',
            'subtitle'              => 'Advanced package for all',
            'photo'                 => null,
            'description'           => '',
            'regular_ticket_count'  => 10,
            'child_ticket_count'    => 0,
            'normal_price'          => 4500,
            'offer_price'           => 2300,
            'branch_id'             => 1,
            'facility_id'           => 2,
            'created_at'            => now(),
        ]);

        DB::table('bundles')->insert([
            'title'                 => 'Starter',
            'subtitle'              => 'Starter package for all',
            'photo'                 => null,
            'description'           => '',
            'regular_ticket_count'  => 5,
            'child_ticket_count'    => 0,
            'normal_price'          => 2300,
            'offer_price'           => 1200,
            'branch_id'             => 1,
            'facility_id'           => 1,
            'created_at'            => now(),
        ]);

        DB::table('bundles')->insert([
            'title'                 => 'Advanced',
            'subtitle'              => 'Advanced package for all',
            'photo'                 => null,
            'description'           => '',
            'regular_ticket_count'  => 10,
            'child_ticket_count'    => 0,
            'normal_price'          => 4500,
            'offer_price'           => 2300,
            'branch_id'             => 2,
            'facility_id'           => 4,
            'created_at'            => now(),
        ]);

        DB::table('bundles')->insert([
            'title'                 => 'Starter',
            'subtitle'              => 'Starter package for all',
            'photo'                 => null,
            'description'           => '',
            'regular_ticket_count'  => 5,
            'child_ticket_count'    => 0,
            'normal_price'          => 2300,
            'offer_price'           => 1200,
            'branch_id'             => 2,
            'facility_id'           => 3,
            'created_at'            => now(),
        ]);
    }
}

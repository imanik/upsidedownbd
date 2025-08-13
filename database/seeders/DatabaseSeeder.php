<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingSeeder::class,
            BranchSeeder::class,
            DesignationSeeder::class,
            EmployeeSeeder::class,
            SlotSeeder::class,
            FacilitySeeder::class,
            AccountCategorySeeder::class,

            CouponSeeder::class,
            BundleSeeder::class,

            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}

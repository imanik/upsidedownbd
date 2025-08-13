<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      => 'Im Anik',
            'email'     => 'imanik007@gmail.com',
            'status'    => 'active',
            'is_admin'  => 1,
            'password'  => bcrypt('imanik007@gmail.com'),
        ]);

        DB::table('users')->insert([
            'name'      => 'Dhanmondi USBD Admin',
            'email'     => 'dusbd@gmail.com',
            'status'    => 'active',
            'is_admin'  => 0,
            'branch_id' => 1,
            'role_id'   => 1,
            'password'  => bcrypt('dusbd@gmail.com'),
        ]);

        DB::table('users')->insert([
            'name'      => 'Uttara USBD Admin',
            'email'     => 'uusbd.u@gmail.com',
            'status'    => 'active',
            'is_admin'  => 0,
            'branch_id' => 2,
            'role_id'   => 1,
            'password'  => bcrypt('usbd.u@gmail.com'),
        ]);

        DB::table('users')->insert([
            'name'      => 'Manager (Uttara)',
            'email'     => 'usbd.uttara@gmail.com',
            'status'    => 'active',
            'is_admin'  => 0,
            'branch_id' => 2,
            'role_id'   => 2,
            'password'  => bcrypt('usbd.uttara@gmail.com'),
        ]);

        DB::table('users')->insert([
            'name'      => 'Manager (Lalmatia)',
            'email'     => 'usbd.lalmatia@gmail.com',
            'status'    => 'active',
            'is_admin'  => 0,
            'branch_id' => 1,
            'role_id'   => 2,
            'password'  => bcrypt('usbd.lalmatia@gmail.com'),
        ]);

        // DB::table('users')->insert([
        //     'name'      => 'Arif Hasan',
        //     'email'     => 'arif.saiket@gmail.com',
        //     'status'    => 'active',
        //     'is_admin'  => 0,
        //     'branch_id' => 2,
        //     'role_id'   => 2,
        //     'password'  => bcrypt('arif.saiket@gmail.com'),
        // ]);
        // User::factory()->count(8)->create();
    }
}

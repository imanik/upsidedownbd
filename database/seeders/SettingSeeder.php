<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            'contact'                   => '+8801615710070',
            'email'                     => 'info@upsidedownbd.com',
            'address'                   => 'House 2/6, Block #C, Lalmatia, Dhaka 1207',
            'facebook_link'             => 'https://www.facebook.com/upsidedownbd/',
            'ticket_validity_in_days'   => '30',
            // 'contact'        => '+88017XXXXXXXX',
            // 'email'      => 'presssales@gmail.com',
            // 'address'        => 'Dhaka, Bangladesh',
            // 'facebook_link'      => 'https://www.facebook.com/presssales/',
            // 'ticket_validity_in_days'        => '30',
        ];

        foreach ($settings as $name => $value) {
            DB::table('settings')->insert([
                'name'  => $name,
                'value' => $value,
            ]);
        }
    }
}

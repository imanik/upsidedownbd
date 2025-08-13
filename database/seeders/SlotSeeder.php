<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slots = [
            1 => [
                'start'     => '11:00 am',
                'end'       => '10:00 pm',
                'duration'  => 15
            ],
            2 => [
                'start'     => '12:00 pm',
                'end'       => '10:00 pm',
                'duration'  => 15
            ],
        ];

        foreach ($slots as $branch_id => $slot) {
            $duration = $slot['duration'];
            $start_time = Carbon::parse($slot['start']);
            $end_time = Carbon::parse($slot['end']);
            do {
                DB::table('slots')->insert([
                    'name'      => 'slot# ' . $start_time->format('h:i a'),
                    'time'      => $start_time->format('h:i a'),
                    'branch_id' => $branch_id,
                ]);
                $start_time->addMinutes($duration);
            } while ($start_time->lt($end_time));
        }
    }
}

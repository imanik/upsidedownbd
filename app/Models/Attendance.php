<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date',
        'check_in',
        'check_out',
        'branch_id',
        'employee_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getCheckIn()
    {
        return !empty($this->check_in) ? Carbon::parse($this->check_in)->format('h:i a') : "N/A";
    }

    public function getCheckOut()
    {
        return !empty($this->check_out) ? Carbon::parse($this->check_out)->format('h:i a') : "N/A";
    }

    public function getDuration()
    {
        return $this->getCheckIn() . ' - ' . $this->getCheckOut();
    }

    public function getTimeDifference()
    {
        $string = '';
        $check_in = $this->check_in ? Carbon::parse($this->check_in) : '';
        $check_out = $this->check_out ? Carbon::parse($this->check_out) : '';
        if ($check_in && $check_out) {
            $hours = $check_in->copy()->diffInHours($check_out);
            $minutes = $check_in->copy()->addHours($hours)->diffInMinutes($check_out);

            $string .= $hours > 1 ? $hours . ' hours ' : ($hours > 0 ? $hours . ' hour ' : '');
            $string .= $minutes > 1 ? $minutes . ' minutes ' : ($minutes > 0 ? $minutes . ' minute ' : '');
        }
        return $string;
    }
}

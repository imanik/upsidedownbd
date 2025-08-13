<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function getStartDate()
    {
        return !empty($this->start_date) ? Carbon::parse($this->start_date)->format('d/m/Y') : "N/A";
    }

    public function getEndDate()
    {
        return !empty($this->end_date) ? Carbon::parse($this->end_date)->format('d/m/Y') : "N/A";
    }

    public function getDate()
    {
        return $this->getStartDate() . ' - ' . $this->getEndDate();
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bundle extends Model
{
    use HasFactory, SoftDeletes;

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function getCreatedAt()
    {
        return !empty($this->created_at) ? Carbon::parse($this->created_at)->format('d/m/Y') : "N/A";
    }
}

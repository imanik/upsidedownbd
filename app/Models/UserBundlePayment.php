<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBundlePayment extends Model
{
    use HasFactory;
    protected $fillable = ['payment_id', 'user_bundle_id'];

    public function user_bundle()
    {
        return $this->belongsTo(UserBundle::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function getCreatedAt()
    {
        return !empty($this->created_at) ? Carbon::parse($this->created_at)->format('d/m/Y') : "N/A";
    }
}

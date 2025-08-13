<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBundle extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_status',
    ];

    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAt()
    {
        return !empty($this->created_at) ? Carbon::parse($this->created_at)->format('d/m/Y') : "N/A";
    }

    public function getRemainingAdult()
    {
        return $this->bundle->regular_ticket_count - UserBundleUsage::where('user_bundle_id', $this->user_bundle_id)->sum('regular_ticket_count');
    }

    public function getRemainingChild()
    {
        return $this->bundle->child_ticket_count - UserBundleUsage::where('user_bundle_id', $this->user_bundle_id)->sum('child_ticket_count');
    }
}

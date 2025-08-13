<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'payment_status',
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function slots()
    {
        return $this->hasMany(TicketSlot::class);
    }

    public function payments()
    {
        return $this->hasMany(TicketPayment::class);
    }

    public function refund()
    {
        return $this->hasOne(Refund::class);
    }

    public function schedules()
    {
        return $this->hasMany(Reschedule::class);
    }

    public function getDate()
    {
        return !empty($this->date) ? Carbon::parse($this->date)->format('d/m/Y') : "N/A";
    }

    public function getCreatedAt()
    {
        return !empty($this->created_at) ? Carbon::parse($this->created_at)->format('jS F, Y h:i a') : "N/A";
    }

    public function getExpireAt()
    {
        return !empty($this->created_at) ? Carbon::parse($this->created_at)->addHour(1)->format('jS F, Y h:i a') : "N/A";
    }
}

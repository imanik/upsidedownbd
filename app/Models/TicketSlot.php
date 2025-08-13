<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSlot extends Model
{
    use HasFactory;

    public function slot()
    {
        return $this->belongsTo(Slot::class)->withTrashed();
    }
}

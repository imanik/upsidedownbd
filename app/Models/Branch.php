<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [];

    public function slots()
    {
        return $this->hasMany(Slot::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }

    public function facility_providers()
    {
        return $this->hasMany(Employee::class);
    }

    public function volunteers()
    {
        return $this->hasMany(Employee::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function bundles()
    {
        return $this->hasMany(Bundle::class);
    }

    public function tickets()
    {
        return $this->hasMany(Branch::class);
    }
}

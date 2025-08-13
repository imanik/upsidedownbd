<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'password',
        'is_member',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'is_member' => 'boolean',
    ];
    
   // protected $table='user';

    public static function insertData($data){
 
       $value=DB::table('users')->where('email', $data['email'])->get();
       if($value->count() == 0){
          DB::table('users')->insert($data);
       }
    }

    public function property_count()
    {
        return $this->hasMany(Property::class, 'user_id')->count();
    }

    public function user_type()
    {
        if ($this->is_admin) {
            return "Super Admin";
        } else if ($this->role) {
            return $this->role->name;
        } else {
            return "Customer";
        }
    }

    public function is_post_limit_exceeds()
    {
        return ($this->property_count() >= config('property.general_post_limit'));
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function valid_properties()
    {
        return $this->hasMany(Property::class)->where('status', 'approved');
    }

    public function valid_properties_count()
    {
        return $this->hasMany(Property::class)->where('status', 'approved')->count();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function bundles()
    {
        return $this->hasMany(UserBundle::class, 'customer_id');
    }

    public function getDate()
    {
        return !empty($this->created_at) ? Carbon::parse($this->created_at)->format('d/m/Y') : "N/A";
    }
}

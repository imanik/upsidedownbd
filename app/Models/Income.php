<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use HasFactory, SoftDeletes;

    public static function insertData($data){
 
        $value=DB::table('incomes')->where('id', $data['id'])->get();
        if($value->count() == 0){
           DB::table('incomes')->insert($data);
        }
     }

    public function getDate()
    {
        return !empty($this->date) ? Carbon::parse($this->date)->format('d/m/Y') : "N/A";
    }
    
    public function getMonth()
    {
        return !empty($this->month) ? Carbon::parse($this->month)->format('m') : "N/A";
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function accountCategory()
    {
        return $this->belongsTo(AccountCategory::class);
    }

    // public function type()
    // {
    //     return $this->hasMany(Transaction::class);
    // }

}

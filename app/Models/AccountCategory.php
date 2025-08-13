<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [];

    public static function insertData($data){
 
        $value=DB::table('account_categories')->where('name', $data['name'])->get();
        if($value->count() == 0){
           DB::table('account_categories')->insert($data);
        }
     }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


}

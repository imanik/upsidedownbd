<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
        use HasFactory, SoftDeletes;

        protected $fillable = [
            'date',
            'amount',
        ];
    

        public static function insertData($data){
 
            $value=DB::table('transactions')->where('id', $data['id'])->get();
            if($value->count() == 0){
               DB::table('transactions')->insert($data);
            }
         }

        public function getDate()
        {
            return !empty($this->date) ? Carbon::parse($this->date)->format('d/m/Y') : "N/A";
        }

        public function accountCategory()
        {
            return $this->belongsTo(AccountCategory::class);
        }

        public function branch()
        {
            return $this->belongsTo(Branch::class);
        }
}

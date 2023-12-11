<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class School_year extends Model
{
    use HasFactory;
    protected $fillable = ['number_course', 'create_at', 'update_at'];
    private $limit = 5;

    public function show(){
        $fillable = DB::table('school_years')->orderBy('school_years.id', 'desc')->paginate($this->limit);
        return $fillable;
    }
    // School_year model

    public function search($searchTerm){
        return DB::table('school_years')
            ->select('school_years.*')
            ->where('school_years.number_course', 'like', "%$searchTerm%")
            ->orderBy('school_years.id', 'desc')
            ->paginate($this->limit);
    }
}

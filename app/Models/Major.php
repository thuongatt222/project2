<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Major extends Model
{
    use HasFactory;
    protected $fillable = ['majors_name', 'create_at', 'update_at'];
    private $limit = 5;

    public function show(){
        $fillable = DB::table('majors')->orderBy('majors.id', 'desc')->paginate($this->limit);
        return $fillable;
    }

    public function search($searchTerm){
        return DB::table('majors')
            ->select('majors.*')
            ->where('majors.majors_name', 'like', "%$searchTerm%")
            ->orderBy('majors.id', 'desc')
            ->paginate($this->limit);
    }

}

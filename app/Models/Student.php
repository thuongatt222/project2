<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['school_payment_times', 'scholarship', 'id_user', 'id_school_year', 'id_major', 'create_at', 'update_at', 'status'];
    private $limit = 5;

    public function show() {
        $fillable = DB::table('students')
            ->join('users', 'students.id_user', '=', 'users.id')
            ->join('majors', 'students.id_major', '=', 'majors.id')
            ->join('school_years', 'students.id_school_year', '=', 'school_years.id')
            ->leftJoin('tuitions', 'tuitions.id_student', '=', 'students.id')
            ->leftJoin('fees', 'fees.id', '=', 'tuitions.id_fee')
            ->select(
                'students.*',
                'users.name',
                'users.student_code',
                'fees.school_payment_times as fee_time',
                'fees.original_fee',
                'school_years.number_course',
                'majors.majors_name',
            )
            ->orderBy('students.id', 'desc')
            ->paginate($this->limit);

        return $fillable;
    }

    public function showYear(){
        $fillable = DB::table('school_years')->get();
        return $fillable;
    }

    public function showMajor(){
        $fillable = DB::table('majors')->get();
        return $fillable;
    }


    public function search($searchTerm){
        return DB::table('students')
            ->join('users', 'students.id_user', '=', 'users.id')
            ->join('majors', 'students.id_major', '=', 'majors.id')
            ->join('school_years', 'students.id_school_year', '=', 'school_years.id')
            ->leftJoin('tuitions', 'tuitions.id_student', '=', 'students.id')
            ->leftJoin('fees', 'fees.id', '=', 'tuitions.id_fee')
            ->select('students.*',
                'users.name',
                'users.student_code',
                'users.id as id_user',
                'fees.school_payment_times as fee_time',
                'fees.original_fee',
                'school_years.number_course',
                'majors.majors_name',
            )
            ->where('users.student_code', 'like', "%$searchTerm%")
            ->orderBy('students.id', 'desc')
            ->paginate($this->limit);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tuition extends Model
{
    use HasFactory;
    protected $fillable = ['payment_times', 'fee', 'note', 'id_student', 'id_fee', 'create_at', 'update_at'];
    private $limit = 5;

    public function show(){
        $fillable = DB::table('tuitions')
            ->join('students', 'tuitions.id_student', '=', 'students.id')
            ->join('fees', 'tuitions.id_fee', '=', 'fees.id')
            ->join('users', 'students.id_user', '=', 'users.id')
            ->join('majors', 'fees.id_major', '=', 'majors.id')
            ->join('school_years', 'fees.id_school_year', '=', 'school_years.id')
            ->select('students.school_payment_times as student_school_payment_times',
             'fees.school_payment_times as fee_time',
              'students.school_payment_times',
              'fees.original_fee',
                'users.name',
               'tuitions.*',
                'majors.majors_name',
                'school_years.number_course',
                'users.student_code',
                'students.id as student_id',
                'users.address',
                'students.scholarship',
            DB::raw('fees.school_payment_times - students.school_payment_times as payment_difference')
            )
            ->orderBy('payment_difference', 'desc')
            ->having('payment_difference', '>', 0)
            ->orderBy('tuitions.id', 'desc')
            ->paginate($this->limit);
        return $fillable;
    }
    public function debt() {
        $fillable = DB::table('students')
            ->leftJoin('tuitions', 'tuitions.id_student', '=', 'students.id')
            ->leftJoin('fees', 'fees.id', '=', 'tuitions.id_fee')
            ->select(
                DB::raw('fees.school_payment_times - students.school_payment_times as payment_difference')
            )
            ->having('payment_difference', '>', 0)
            ->get();

        return $fillable;
    }

    public function showStudent()
    {
        $fillable = DB::table('students')
            ->join('users', 'students.id_user', '=', 'users.id')
            ->select('students.*', 'users.name')
            ->get();
        return $fillable;
    }

    public function showFee(){
        $fillable = DB::table('fees')
            ->join('majors', 'fees.id_major', '=', 'majors.id')
            ->join('school_years', 'fees.id_school_year', '=', 'school_years.id')
            ->select( 'fees.*', 'majors.majors_name', 'school_years.number_course')
            ->get();
        return $fillable;
    }

   public function search($searchTerm){
       return DB::table('tuitions')
           ->join('students', 'tuitions.id_student', '=', 'students.id')
           ->join('fees', 'tuitions.id_fee', '=', 'fees.id')
           ->join('users', 'students.id_user', '=', 'users.id')
           ->join('majors', 'fees.id_major', '=', 'majors.id')
           ->join('school_years', 'fees.id_school_year', '=', 'school_years.id')
           ->select('students.school_payment_times as student_school_payment_times',
                'fees.school_payment_times as fee_time',
               'students.school_payment_times',
                'fees.original_fee',
                'users.name',
                'tuitions.*',
                'majors.majors_name',
                'school_years.number_course',
                'users.student_code',
                'students.id as student_id',
                'students.scholarship',
                'users.address',
           )
           ->where('users.student_code', 'like', "%$searchTerm%")
           ->orderBy('tuitions.id', 'desc')
           ->paginate($this->limit);
   }
}

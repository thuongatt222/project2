<?php

namespace App\Imports;

use App\Models\Fee;
use App\Models\Major;
use App\Models\School_year;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Tuition;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersImport implements ToCollection, WithHeadingRow
{
    public function headingRow(): int
    {
        return 1;
    }

    public function collection(Collection $collection)
    {

        foreach ($collection as $row) {
                $timestamp = ($row['birthday'] - 25569) * 86400;
                $date = date('Y-m-d', $timestamp);
            $check = User::Where('student_code', $row['student_code'])
            ->Where('email', $row['email'])
            ->Where('cccd', $row['cccd'])
            ->Where('phone_number', $row['phone_number'])->exists();
            if ($check == true) {
                continue;
            }else{
            $id_major = Major::where('majors_name', $row['major'])->value('id');
            $id_year = School_year::where('number_course', $row['school_year'])->value('id');

            $id_fee = Fee::where('id_school_year', $id_year)

            ->Where('id_major', $id_major)
            ->value('id');
            $user = User::create([
                'student_code' => $row['student_code'],
                'name' => $row['name'],
                'email' => $row['email'],
                'birthday' => $date ,
                'address' => $row['address'],
                'phone_number' => $row['phone_number'],
                'cccd' => $row['cccd'],
                'role' => 0,
                'created_at' => now(),
            ]);

            $student = Student::create([
                'id_user' => $user->id,
                'scholarship' => $row['scholarship'],
                'status' => 1,
                'school_payment_times' => 0,
                'id_school_year'=> $id_year,
                'id_major'=> $id_major,
                'created_at' => now(),
            ]);
            $scholarship = Student::where('id', $student->id)->value('scholarship');
            $original_fee = Fee::where('id', $id_fee)->value('original_fee');
            $fee = round(($original_fee - $scholarship) / 30);
            $tuition = Tuition::create([
                'payment_times' => 0,
                'id_student' => $student->id,
                'fee' => $fee,
                'id_fee' => $id_fee,
                'created_at' => now(),
            ]);
            }
        }
        if(!empty($student) && !empty($user) && !empty($tuition)){
            flash()->addSuccess('Thêm thành công');
        }else{

            flash()->addError("Thêm thất bại - Dữ liệu đã tồn tại");
        }
    }
}

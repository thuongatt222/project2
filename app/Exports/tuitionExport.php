<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class tuitionExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('tuitions')
        ->join('students', 'tuitions.id_student', '=', 'students.id')
        ->join('fees', 'tuitions.id_fee', '=', 'fees.id')
        ->join('users', 'students.id_user', '=', 'users.id')
        ->select('tuitions.id', 'tuitions.payment_times', 'tuitions.fee', 'tuitions.note', 'users.name' , 'fees.school_payment_times')
        ->get();
    }
    public function headings(): array
    {
        // Define the headings for your Excel file
        return [
            'STT',
            'Lần đóng',
            'Số tiền đóng',
            'Ghi chú',
            'Học sinh',
            'Đợt đóng',
        ];
    }
}

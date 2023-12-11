<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class UsersExport implements FromCollection{
public function collection()
{
    $data = [
        [
            'Student code' => 'Student code',
            'Name' =>'Name',
            'Email' => 'Email',
            'Birthday' => 'Birthday',
            'Address' => 'Address',
            'Phone number' => 'Phone number',
            'CCCD' => 'CCCD',
            'Scholarship' =>'Scholarship',
            'Major'=> 'Major',
            'School year'=> 'School year',
        ],
        // Add more data rows as needed
    ];

    return new Collection($data);
}
}

<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::all()->map(function ($row) {
            return [
                'Id' => $row->id,
                'Name' => $row->name,
                'Date of birth' => $row->dob,
                'Date of joining' => $row->doj,
                'Gender' => $row->gender,
                'Designation' => $row->designation,
                'Manager' => $row->manager,
                'Picture' => $row->picture,
                'Email' => $row->email
                // Add more columns here
            ];
        });;
    }
}

<?php

namespace App\Exports;

use App\Models\Question;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $final_degree = Question::getFinalDegree();
        $passing_degree = Question::getPassingDegree();

        return User::students()->get()->map(function($user) use ($final_degree, $passing_degree){
            return [
                'id' => $user->id,
                'name' => $user->name,
                'degree' => $user->degree,
                'result' => $user->degree >= $passing_degree?'Passed':'Failed',
                'percentage' => "%".$this->calculatePercentage($user->degree, $final_degree),
                'final' => $final_degree,
            ];
        });
    }

    
    private function calculatePercentage($degree, $final_degree){
        return ceil(($degree/$final_degree)*100);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Degree',
            'Result',
            'Percentage',
            'Test Full Degree',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 15,            
            'C' => 15,            
            'D' => 30,            
            'E' => 15,            
            'F' => 15,            
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

}

<?php

namespace App\Exports;

use App\Models\Question;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class UsersExport implements FromCollection, WithHeadings
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

}

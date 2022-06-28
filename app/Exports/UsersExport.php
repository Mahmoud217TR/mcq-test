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
        $final_degree = Question::sum('degree');
        return User::students()->get()->map(function($user) use ($final_degree){
            return [
                'id' => $user->id,
                'name' => $user->name,
                'degree' => $user->degree,
                'final' => $final_degree,
                'percentage' => "%".$this->calculatePercentage($user->degree, $final_degree),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Degree',
            'Final',
            'Percentage',
        ];
    }

    private function calculatePercentage($degree, $final_degree){
        return ceil(($degree/$final_degree)*100);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function submit(){
        $degree = $this->calculateDegree();

        auth()->user()->update(['degree' => $degree]);

        return response()->json([
            'redirect' => route('test.result'),
        ]);
    }

    public function results(){
        $final_degree = Question::sum('degree');
        $degree = auth()->user()->degree;
        $percentage = $this->calculatePercentage($degree, $final_degree);
        $result = $percentage>=50?"Passed":"Failure";

        return response()->json([
            'degree' => $degree,
            'final' => $final_degree,
            'percentage' => $percentage,
            'result' => $result,
        ]);
    }

    private function calculateDegree(){
        $student_answers = auth()->user()->questions;
        $degree = 0;
        foreach($student_answers as $student_answer){
            if($student_answer->pivot->choice == $student_answer->answer){
                $degree += $student_answer->degree;
            }
        }
        return $degree;
    }

    private function calculatePercentage($degree, $final_degree){
        return ceil(($degree/$final_degree)*100);
    }
}

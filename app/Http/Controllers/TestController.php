<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Question;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function show(){
        $final_degree = Question::sum('degree');
        $degree = auth()->user()->degree;
        $percentage = $this->calculatePercentage($degree, $final_degree);
        $result = $percentage>=50?"Passed":"Failed";

        return view('result', compact('final_degree','degree','percentage','result'));
    }

    public function index(){
        return view('test.index');
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'results.xlsx');
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

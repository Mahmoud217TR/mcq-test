<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index(){
        $answers = auth()->user()->questions;
        return response()->json([
            'answers' => $this->formatAnswers($answers),
        ]);
    }
    
    private function formatAnswers($answers){
        return $answers->map(function ($answer) {
            return [
                'question_id' => $answer->pivot->question_id,
                'choice' => $answer->pivot->choice,
            ];
        });
    }

    public function store(){
        return response()->json([
            'request' => request()->all(),
        ]);
    }
}

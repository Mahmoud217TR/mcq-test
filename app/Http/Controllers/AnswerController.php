<?php

namespace App\Http\Controllers;

use App\Models\Question;
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
        $question_id = request()->question_id;
        $choice = request()->choice;
        auth()->user()->registerAnswer($question_id, $choice);
        return response()->json([
            'code' => 200,
        ]);
    }
}

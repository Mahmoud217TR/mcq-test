<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(){
        $questions = Question::all();
        return response()->json([
            'questions' => $this->formatQuestions($questions),
        ]);
    }

    private function formatQuestions($questions){
        return $questions->map(function ($question) {
            return [
                'id' => $question->id,
                'question' => $question->content,
                'degree' => $question->degree,
                'choices' => [
                    '1' => $question->choice1,
                    '2' => $question->choice2,
                    '3' => $question->choice3,
                    '4' => $question->choice4,
                ],
            ];
        });
    }

}

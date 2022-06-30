<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except('index');
    }

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

    public function show(){
        $question = Question::findOr(request()->id,function(){
            return response()->json([
                'code' => '404',
                'message' => 'Question Not Found!!',
            ]);
        });
        return response()->json([
            'content' => $question->content,
            'degree' => $question->degree,
            'answer' => $question->answer,
            'choice1' => $question->choice1,
            'choice2' => $question->choice2,
            'choice3' => $question->choice3,
            'choice4' => $question->choice4,
        ]);
    }

    public function create(){
        return view('question.create');
    }

    public function store(){
        $validator = $this->getValidator();
        
        if ($validator->passes()){
            Question::create($validator->validated());
            return response()->json([
                'code' => 200,
            ]);
        }
        return response()->json([
            'code' => 422,
                'errors' => $validator->errors()->toArray(),
        ]);
        
    }
    public function update(){
        $validator = $this->getValidator();

        if($validator->passes()){
            $this->updatQuestion($validator->validated());
            return response()->json([
                'code' => 200,
            ]);
        }else{
            return response()->json([
                'code' => 422,
                'errors' => $validator->errors()->toArray(),
            ]);
        }
    }

    private function getValidator(){
        return Validator::make(request()->all(),[
            'id' => 'exists:questions,id',
            'content' => 'required|string',
            'degree' => 'required|numeric|min:1',
            'answer' => 'required|numeric|min:1|max:3',
            'choice1'=> 'nullable|string|required_without_all:choice2,choice3,choice4',
            'choice2'=> 'nullable|string|required_without_all:choice1,choice3,choice4',
            'choice3'=> 'nullable|string|required_without_all:choice1,choice2,choice4',
            'choice4'=> 'nullable|string|required_without_all:choice1,choice2,choice3',
        ]);
    }

    private function updatQuestion($data){
        Question::find($data['id'])->update([
            'content' => $data['content'],
            'degree' => $data['degree'],
            'answer' => $data['answer'],
            'choice1' => $data['choice1'],
            'choice2' => $data['choice2'],
            'choice3' => $data['choice3'],
            'choice4' => $data['choice4'],
        ]);
    }

    public function destroy(){
        $question = Question::findOr(request()->id,function(){
            return response()->json([
                'code' => '200',
            ]);
        });

        $question->delete();
        return response()->json([
            'code' => '200',
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','admin']);
    }

    public function index(){
        $students = User::Students()->get();
        return response()->json([
            'students' => $students,
        ]);
    }

    public function create(){
        return view('student.create');
    }

    public function store(){
        $validator = $this->getValidator();

        if($validator->passes()){
            $user = $this->createUser($validator->validated());
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    private function createUser($data){
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}

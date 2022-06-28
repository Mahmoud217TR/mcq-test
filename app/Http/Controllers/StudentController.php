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

    public function show(){
        $user = User::findOr(request()->id,function(){
            return response()->json([
                'code' => '404',
                'message' => 'User Not Found!!',
            ]);
        });
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function create(){
        return view('student.create');
    }

    public function store(){
        $validator = $this->getCreateValidator();

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

    private function getCreateValidator(){
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

    public function update(){
        $validator = $this->getUpdateValidator();

        if($validator->passes()){
            $this->updatUser($validator->validated());
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

    private function getUpdateValidator(){
        return Validator::make(request()->all(),[
            'id' => ['required', 'numeric', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.request()->id],
            'password' => ['nullable', 'string', 'min:8'],
        ]);
    }

    private function updatUser($data){
        if($data['password']){
            User::find($data['id'])->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }else{
            User::find($data['id'])->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);
        }
        
    }

    public function destroy(){
        $user = User::findOr(request()->id,function(){
            return response()->json([
                'code' => '200',
            ]);
        });

        $user->delete();
        return response()->json([
            'code' => '200',
        ]);
    }
}

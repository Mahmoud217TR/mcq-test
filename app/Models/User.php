<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'degree',
    ];

    protected $attributes = [
        'role' => 1,
        'degree' => null,
    ];

    public static function roles(){
        return [
            1 => 'student',
            2 => 'admin',
        ];
    }

    public function role(): Attribute{
        return Attribute::make(
            get: fn ($value) => $this->roles()[$value],
            set: fn ($value) => array_search($value,$this->roles()),
        );
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relatioins
    public function questions(){
        return $this->belongsToMany(Question::class)->withPivot('choice');
    }

    // Scopes
    public function scopeStudents($query){
        return $query->where('role',1);
    }

    // Functions
    public function isAdmin(){
        return $this->role == 'admin';
    }
    
    public function getAnswerToQuestion(Question $question){
        return $this->questions()->where('question_id', $question->id)->first()->pivot->choice;
    }

    public function hasTakenTest(){
        return $this->degree != null;
    }

    public function registerAnswer($question, $choice){
        $this->questions()->detach($question);
        $this->questions()->attach($question, ['choice'=>$choice]);
    }
}

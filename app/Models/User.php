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

    public function scopeTested($query){
        return $query->students()->whereNotNull('degree');
    }

    public function scopePassed($query){
        return $query->tested()->where('degree','>=',Question::getPassingDegree());
    
    }

    public function scopeFailed($query){
        return $query->tested()->where('degree','<',Question::getPassingDegree());
    }

    // Functions
    public function isAdmin(){
        return $this->role == 'admin';
    }

    public function isEligible(){
        return $this->degree == null;
    }

    public function hasPassed(){
        return $this->degree > Question::getPassingDegree();
    }
    
    public function getAnswerToQuestion(Question $question){
        return $this->questions()->where('question_id', $question->id)->first()->pivot->choice;
    }

    public function registerAnswer($question, $choice){
        $this->questions()->detach($question);
        $this->questions()->attach($question, ['choice'=>$choice]);
    }
}

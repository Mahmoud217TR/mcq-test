<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'degree',
        'choice1',
        'choice2',
        'choice3',
        'choice4',
        'answer',
    ];

    // Relations 
    public function users(){
        return $this->belongsToMany(User::class)->withPivot('choice');
    }
}

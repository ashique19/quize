<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quize extends Model
{
    use HasFactory;

    protected $table = 'quizes';

    protected $fillable = [
        'field1', // title
        'field2', // description
        'field3', // is published ?: draft
    ];

    
    protected $casts = ['field3'=>'boolean'];


    /**
     * Quize has many questions
     * @return collection of questions
     * */ 
    public function questions()
    {

        return $this->hasMany('\App\Models\quizeQuestion');

    }


}

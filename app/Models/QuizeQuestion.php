<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizeQuestion extends Model
{
    use HasFactory;

    protected $table = 'quizeQuestions';

    protected $fillable = [
        'field1', // title
        'quize_id', // foregin key
        'field3'    // is mandatory || bool
    ];

    /**
     * Question belongs to a quize
     * */ 
    public function quize()
    {

        return $this->belongsTo('\App\Models\Quize');

    }


    /**
     * Question has many options
     * 
    */
    public function options()
    {

        return $this->hasMany('\App\Models\QuizeQuestionOption');

    }
}

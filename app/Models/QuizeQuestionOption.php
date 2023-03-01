<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizeQuestionOption extends Model
{
    use HasFactory;

    protected $table = 'quizeQuestionOptions';

    protected $fillable = [
        'field1', // title
        'field2', // is right answer?
        'quizeQuestion_id', // referring question
    ];


    /**
     * belongs to a question
    */
    public function question()
    {

        return $this->belongsTo('\App\Models\QuizeQuestion');

    }
}

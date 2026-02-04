<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tempanswers extends Model
{


    protected $fillable = ['exam_id', 'question_id', 'answer', 'is_true'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}

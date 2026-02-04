<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Answer extends Model
{

    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['exam_id', 'question_id', 'answer', 'is_true'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function getStatusAttribute()
    {
        return $this->answer == $this->question->true_answer;
    }
}

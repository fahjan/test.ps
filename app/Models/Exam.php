<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Exam extends Model
{
    use \App\Traits\Search;
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'finished_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = ['created_at', 'finished_at', 'student_id', 'grade', 'questions_count', 'application'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getResultAttribute()
    {
        return $this->questions_count . '/' . $this->grade;
    }

    public function scopeSameStudent($query)
    {
        return $query->where('student_id', auth()->user()->student()->id);
    }

    public function getPercentAttribute()
    {
        return ($this->grade / $this->questions_count) * 100;
    }

    public function getFinishedAttribute()
    {
        return $this->finished_at->format('Y/m/d');
    }

    // public function questions()
    // {
    //     return $this->belongsToMany(Question::class)->withPivot('answer');
    // }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}

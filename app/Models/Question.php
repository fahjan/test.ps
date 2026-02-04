<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Question extends Model
{
    // use Sortable;
    use \App\Traits\Search;

    protected $fillable = [
        'question', 'answer1', 'answer2', 'answer3', 'answer4', 'true_answer', 'type_id', 'license_id',
        'category', 'question_photo', 'answers_photo'
    ];

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }



    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function answer()
    {
        return $this->hasOne(Answer::class);
    }

    public function getImagesAttribute()
    {
        $question_images = [];
        $answers_images = [];
        if ($this->question_photo) {
            $question_images = explode(';', $this->question_photo);
        }
        if ($this->answers_photo) {
            $answers_images = explode(';', $this->answers_photo);
        }
        return array_merge($question_images, $answers_images);
    }

    public function scopeFilter($query)
    {
        return $query->when(request('title'), function ($query, $title) {
            $query->where('question', 'like', '%' . $title . '%');
        })->when(request('category'), function ($query, $category) {
            $query->where('category', $category);
        })->when(request('license_id'), function ($query, $license_id) {
            $query->where('license_id', $license_id);
        })->when(request('type_id'), function ($query, $type_id) {
            $query->where('type_id', $type_id);
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use \App\Traits\Search;
    use \App\Traits\UserTrait;

    protected $fillable = ['user_id', 'school_id', 'photo', 'status'];
    protected $searchable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }


    public function scopeSchool($query)
    {
        return $query->where('school_id', auth()->user()->managerSchool->id);
    }
}

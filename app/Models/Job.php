<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use \App\Traits\Search;

    protected $fillable = ['title'];

    public function trainers()
    {
        return $this->belongsToMany(Trainer::class);
    }
}

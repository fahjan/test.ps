<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use \App\Traits\Search;

    protected $fillable = ['title'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}

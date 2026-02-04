<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use \App\Traits\Search;

    protected $fillable = ['title'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}

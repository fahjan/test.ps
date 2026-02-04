<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use \App\Traits\Search;


    protected $fillable = ['title', 'country_id'];
    protected $searchable = ['title'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function students()
    {
        // return $this->hasMany(Students::class);
    }
    public function schools()
    {
        return $this->hasMany(School::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    use \App\Traits\Search;


    protected $fillable = ['title', 'description', 'country_id', 'number', 'image_path', 'related'];
    protected $searchable = ['title', 'description'];
    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function getImageAttribute()
    {
        return asset('uploads/signs/' . $this->image_path);
        // return $this->hasMany(Students::class);
    }

    public function getSoundAttribute()
    {
        return asset('uploads/sign_sounds/' . $this->number . '.');
    }
}

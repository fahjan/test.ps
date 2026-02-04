<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examiner extends Model
{
    use \App\Traits\Search;

    protected $fillable = ['name', 'city_id'];
    protected $searchable = ['name'];
    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

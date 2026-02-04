<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicletype extends Model
{
    //

    protected $fillable = ['title'];
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}

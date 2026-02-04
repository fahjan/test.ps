<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    use \App\Traits\Search;

    protected $fillable = ['title'];
    protected $searchable = ['title'];
    public $timestamps = false;

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

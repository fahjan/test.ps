<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use \App\Traits\Search;
    use \App\Traits\UserTrait;

    protected $fillable = ['school_id', 'user_id', 'photo', 'status', 'can_edit', 'can_delete'];
    protected $searchable = ['status'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class School extends Model
{
    // use Sortable;
    use HasUuids;
    use \App\Traits\Search;

    protected $fillable = [
        'title',
        'slug',
        'city_id',
        'email',
        'phone',
        'mobile',
        'address',
        'logo',
        'app_bg',
        'status',
        'sms_provider',
        'sms_key',
        'sms_secret',
        'sms_sender'
    ];

    protected $searchable = ['title', 'address'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function managers()
    {
        return $this->hasMany(Manager::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}

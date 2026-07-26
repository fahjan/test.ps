<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;


class School extends Model
{
    // use HasUuids;
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

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public function trainers()
    {
        return $this->hasMany(Trainer::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // relation to lessons through students
    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Student::class);
    }

    // relation to payments through students
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Student::class);
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class);
    }
}

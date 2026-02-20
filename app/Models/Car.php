<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Car extends Model
{
    use \App\Traits\Search;
    use \App\Traits\UserTrait;

    protected $fillable = ['title', 'notes', 'school_id', 'car_number', 'renewal_at', 'insurance_at', 'model_year', 'trainer_id', 'vehicletype_id', 'status'];

    // public $serachable = ['', ''];
    protected $searchable = ['title', 'car_number'];

    public $dates = ['renewal_at', 'insurance_at'];


    public function getRenewalAtAttribute($val)
    {
        return Carbon::parse($val)->format('Y-m-d');
    }

    public function getInsuranceAtAttribute($val)
    {
        return Carbon::parse($val)->format('Y-m-d');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }


    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function vehicletype()
    {
        return $this->belongsTo(Vehicletype::class);
    }

    public function scopeSchool($query)
    {
        return $query->where('school_id', auth()->user()->managerSchool->id);
    }
}

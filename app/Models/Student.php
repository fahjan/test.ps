<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;


class Student extends Model
{
    use \App\Traits\UserTrait;
    use \App\Traits\Search;
    use HasUuids;
    use SoftDeletes;


    protected $keyType = 'string';
    public $incrementing = false;

    public $sortable = [
        'id',
        'name',
        'license_id',
        'gender',
        'archive_number',
        'affiliated_at'
    ];

    protected $fillable = [
        'first_name',
        'father_name',
        'gfather_name',
        'family_name',
        'id_number',
        'city_id',
        'school_id',
        'photo',
        'dateofbirth',
        'gender',
        'address',
        'glasses',
        'license_id',
        'exam_type',
        'agreed_amount',
        'prev_license',
        'prev_place',
        'prev_number',
        'prev_end_date',
        'license_number',
        'license_end_at',
        'training_number',
        'training_end_at',
        'trainer_id',
        'drivingtrainer_id',
        'user_id',
        'archive_number',
        'affiliated_at',
        'medical_checked_at',
        'theoretical_at',
        'tested_at',
        'status',
        'agreed_lessons',
        'active',
        'use_app',
        'is_disabled',
    ];

    protected $searchable = ['family_name', 'id_number', 'archive_number', 'license_number'];

    public $dates = [
        'prev_end_date',
        'training_end_at',
        'dateofbirth',
        'theoretical_at',
        'tested_at',
        'affiliated_at',
        'medical_checked_at',
    ];

    protected $casts = [
        'is_disabled' => 'boolean',
    ];

    // protected $dateFormat = 'Y-m-d';

    // public function getDateofbirthAttribute($val)
    // {

    //     return $val == null ? null : Carbon::parse($val)->format("d/m/Y");
    // }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->father_name} {$this->gfather_name} {$this->family_name}";
    }

    public function getTrainingEndAtAttribute($val)
    {

        return $val == null ? null : Carbon::parse($val)->format('d/m/Y');
    }

    public function getAffiliatedAtAttribute($val)
    {
        // dd($val ,Carbon::parse($val)->format("d/m/Y"));
        return $val == null ? null : Carbon::parse($val)->format('d/m/Y');
    }

    public function getNeedMedicalAttribute($val): bool
    {

        $years_for_recheck = $this->license_id == 1 ? 5 : 5;

        if ($this->medical_checked_at == null) {
            return true;
        }

        return Carbon::createFromFormat('d/m/Y', $this->medical_checked_at)->diffInYears(Carbon::now()) > $years_for_recheck;
    }

    public function getMedicalCheckedAtAttribute($val)
    {
        return $val == null || $val == '' ? null : Carbon::parse($val)->format('d/m/Y');
    }

    public function getCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function setPrevEndDateAttribute($date)
    {

        $this->attributes['prev_end_date'] = $date == null ? null : Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }

    public function setAffiliatedAtAttribute($date)
    {

        $this->attributes['affiliated_at'] = $date == null ? null : Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }

    public function setMedicalCheckedAtAttribute($date)
    {
        $this->attributes['medical_checked_at'] = $date == null ? null : Carbon::parse($date)->format('Y-m-d');
    }

    public function setDateofbirthAttribute($date)
    {

        $this->attributes['dateofbirth'] = $date == null ? null : Carbon::parse($date)->format('Y-m-d');
    }

    public function getPrevEndDateAttribute($val)
    {
        return $val == null ? null : Carbon::parse($val)->format('d/m/Y');
    }



    public function getPhotoUrlAttribute()
    {
        return asset('img/100x100-' . $this->photo);
    }

    public function getNumberAttribute()
    {
        if (strpos($this->archive_number, '-') !== false) {
            return explode('-', $this->archive_number)[1];
        }
        return $this->archive_number;
    }

    public function getTheoreticalAttribute()
    {
        return $this->theoretical_at->format('d/m/Y');
    }

    public function getTestedAttribute()
    {
        return $this->tested_at->format('d/m/Y');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function drivingtrainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class); //->latest('lesson_at');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->latest('invoiced_at');
    }

    public function scopeSchool($query)
    {
        return $query->where('school_id', auth()->user()->managerSchool->id);
    }

    public function getPercentAttribute()
    {


        $student_id = $this->id;
        // DB::enableQueryLog();
        $questions = Cache::rememberForever('questions_count_license_' . $this->license_id . '_category_' . $this->exam_type, function () {
            return Question::where('license_id', '<=', $this->license_id)
                ->where('category', $this->exam_type)->count();
        });

        $questions = $questions > 0 ? $questions : 1;



        $student_exams = Exam::select('id')
            ->from('exams')
            ->where('student_id', $student_id)->get()->pluck('id', 'id')->toArray();

        $answers = Answer::select('question_id')->where('is_true', 'true')->whereIn('exam_id', array_values($student_exams))
            ->count(DB::raw('DISTINCT question_id'));

        return $answers / $questions;
    }
}

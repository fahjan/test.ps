<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use \App\Traits\Search;
    use \App\Traits\UserTrait;
    use HasUuids;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;
    public $dates = ['lesson_at'];

    protected $fillable = ['student_id', 'car_id', 'trainer_id', 'notes', 'lesson_at'];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // public function setLessonAtAttribute($date)
    // {

    //     $this->attributes['lesson_at'] = $date == null ? null : Carbon::createFromFormat('d/m/Y H:i', $date)->format('Y-m-d H:i:s');
    // }

    public function rowClass(int $iteration)
    {
        $agreed_lessons = $this->student->agreed_lessons;
        $second_test_lessons = 10;

        if ($iteration > $agreed_lessons && $iteration <= $agreed_lessons + $second_test_lessons) {
            return 'table-warning';
        }
        if ($iteration > $agreed_lessons + $second_test_lessons) {
            return 'table-danger';
        }

        return '';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{

    use \App\Traits\Search;
    use \App\Traits\UserTrait;
    use HasUuids;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;


    protected $fillable = ['invoiced_at', 'student_id', 'invoice_number', 'amount', 'kind_id', 'notes'];
    public $dates = ['invoiced_at'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function kind()
    {
        return $this->belongsTo(Kind::class);
    }

    public function getInvoicedAttribute()
    {
        return $this->invoiced_at->format('Y/m/d');
    }
}

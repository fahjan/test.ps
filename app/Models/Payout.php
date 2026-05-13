<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payout extends Model
{
    use HasFactory;

    /**
     * الحقول القابلة للتعبئة جماعياً (Mass Assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'school_id',
        'amount',
        'payment_method',
        'notes',
        'paid_at',
    ];

    /**
     * تحويل الحقول تلقائياً إلى أنواع البيانات المناسبة عند التعامل معها.
     *
     * @var array<string, string>
     */

    protected function casts()
    {
        return [
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    /**
     * علاقة الدفعة بالمدرسة: كل دفعة تنتمي إلى مدرسة واحدة.
     *
     * @return BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }


}

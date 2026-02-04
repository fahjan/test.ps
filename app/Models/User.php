<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use \App\Traits\Search;
    use HasRoles;
    use HasUuids;
    use HasApiTokens;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'id_number',
        'code',
        'device_info',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function getMobileAttribute($mobile)
    {
        return ltrim($mobile, '97');
    }

    public function managers()
    {
        return $this->hasMany(Manager::class);
    }

    public function school()
    {
        return $this->hasOne(Manager::class)->latest()->first()->school();
    }

    public function managerSchool()
    {
        // dd(auth()->guard('manager')->id());
        return $this->hasOne(Manager::class)->latest()->first()->school();
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class)->latest()->first();
    }

    public function studentSchool()
    {
        return $this->hasOne(Student::class)->latest()->first()->school();
    }

    public function trainers()
    {
        return $this->hasMany(Trainer::class);
    }

    public function trainerSchool()
    {
        return $this->hasOne(Trainer::class)->latest()->first()->school();
    }
}

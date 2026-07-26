<?php

namespace App\Policies;

use App\Models\Lecture;
use App\Models\School;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;

class LecturePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, School $school): bool
    {
        $isStudent = DB::table('students')
            ->where('user_id', $user->id)
            ->where('school_id', $school->id)
            ->exists();

        if ($isStudent) {
            return true;
        }

        // 2. أو تحقق إن كان مديراً للمدرسة (ليتمكن من رؤية ما أضافه)
        return DB::table('managers')
            ->where('user_id', $user->id)
            ->where('school_id', $school->id)
            ->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Lecture $lecture): bool
    {
        // 1. تحقق أولاً إن كان طالباً في المدرسة
        $isStudent = DB::table('students')
            ->where('user_id', $user->id)
            ->where('school_id', $lecture->school_id)
            ->exists();

        if ($isStudent) {
            return true;
        }

        // 2. أو تحقق إن كان مديراً للمدرسة (ليتمكن من رؤية ما أضافه)
        return DB::table('managers')
            ->where('user_id', $user->id)
            ->where('school_id', $lecture->school_id)
            ->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, School $school): bool
    {
        return DB::table('managers')
            ->where('user_id', $user->id)
            ->where('school_id', $school->id)
            ->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Lecture $lecture): bool
    {
        return DB::table('managers')
            ->where('user_id', $user->id)
            ->where('school_id', $lecture->school_id)
            ->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Lecture $lecture): bool
    {
        return DB::table('managers')
            ->where('user_id', $user->id)
            ->where('school_id', $lecture->school_id)
            ->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Lecture $lecture): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Lecture $lecture): bool
    {
        return false;
    }
}

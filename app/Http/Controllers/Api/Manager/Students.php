<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\DeleteStudentRequest;
use App\Http\Requests\ManagerCanViewStudentsBySchoolIdRequest;
use App\Http\Requests\StudentGraduateRequest;
use App\Http\Resources\SimpleStudentResource;
use App\Models\School;
use App\Models\User;
use App\Notifications\SendPassword;
use Hash;
use Illuminate\Http\Request;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use DB;

class Students extends Controller
{
    public function index(ManagerCanViewStudentsBySchoolIdRequest $request)
    {

        $students = Student::where('school_id', $request->school_id)
            ->with(['user'])
            ->when($request->active, function ($q, $active) {
                return $q->where('active', $active);
            })

            ->when($request->search, function ($q, $search) {
                return $q->whereLike('family_name', '%' . $search . '%');
            })

            ->withCount([
                'lessons',
                'payments as payments_sum' => function ($q) {
                    return $q->select(DB::raw('SUM(amount) as payments_sum'));
                }
            ])
            ->with(['user', 'city'])
            ->latest()->simplePaginate();

        return SimpleStudentResource::collection($students);
    }

    public function store(CreateStudentRequest $request)
    {

        $data = $request->validated();

        $user = [];

        $user['mobile'] = ltrim((string) phone($request->mobile, config('services.countries')), '+');
        $user['id_number'] = $request->id_number;
        $user['name'] = $request->first_name . ' ' . $request->father_name . ' ' . $request->gfather_name . ' ' . $request->family_name;

        // $school = auth()->user()->school;

        $school = School::find($request->school_id);


        $first_user = User::
            where('mobile', $user['mobile'])
            ->orWhere('id_number', $user['id_number'])->first();

        if ($first_user) {
            $data['archive_number'] = $request->archive_number ?? $school->id . '-' . (Student::where('school_id', $school->id)->count() + 1);

            Student::create(
                [
                    'school_id' => $school->id,
                    'user_id' => $first_user->id,
                ] + $data,

            );
            return;
        }


        $password = mt_rand(1111, 9999);

        $user['code'] = $password;
        $user['password'] = Hash::make($password);


        $created_user = User::
            where('mobile', $user['mobile'])
            ->orWhere('id_number', $user['id_number'])
            ->firstOr(fn() => User::create($user));


        $data['archive_number'] = $request->archive_number ?? $school->id . '-' . (Student::where('school_id', $school->id)->count() + 1);

        Student::create(
            [
                'school_id' => $school->id,
                'user_id' => $created_user->id,
            ] + $data,

        );

        $sms_provider = [];

        if ($school->sms_sender != '') {
            $sms_provider = [
                'sender' => $school->sms_sender,
                'secret' => $school->sms_secret,
                'key' => $school->sms_key,
            ];
        }

        $created_user->notify(new SendPassword(['message' => 'اسم المستخدم: ' . ltrim($user['mobile'], '97') . ' : ' . 'كلمة المرور: ' . $password . ', ' . url('/app')], $sms_provider));

    }


    public function show($id)
    {
        //
    }

    public function update(StudentGraduateRequest $request, Student $student)
    {


        $student->{$request->field} = $request->value;
        $student->save();

        return Student::select(['id', 'theoretical_at', 'tested_at'])->where('id', $student->id)->first();

    }

    public function destroy(DeleteStudentRequest $request, Student $student)
    {
        return $student->delete();
    }
}

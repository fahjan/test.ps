<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListTrainersRequest;
use App\Http\Resources\TrainerResource;
use App\Models\Manager;
use App\Models\Trainer;
use App\Models\User;
use App\Notifications\SendPassword;
use Hash;
use Illuminate\Http\Request;

class Trainers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ListTrainersRequest $request)
    {

        return cache()->rememberForever("school-trainers:$request->school_id", function () use ($request) {

            $trainers = Trainer::with(['user', 'school'])->whereHas('school', function ($q) use ($request) {
                return $q->where('id', $request->school_id);
            })->get();

            return TrainerResource::collection($trainers);
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListTrainersRequest $request)
    {
        cache()->forget("school-trainers:$request->school_id");

        $mobile = phone($request->mobile, config('services.countries'));

        $find_user = User::where('mobile', $mobile)->orWhere('id_number', $request->id_number)->first();

        // if ($find_user) {
        Manager::firstOrCreate([
            'school_id' => $request->school_id,
            'user_id' => $find_user->id
        ]);
        return $this->index($request);
        // }

        $user['mobile'] = $mobile;
        $user['id_number'] = $request->id_number;
        $user['name'] = $request->name;
        $user['password'] = mt_rand(1111, 9999);


        $created_user = User::create($user);

        Manager::updateOrCreate(['school_id' => $request->school_id, 'user_id' => $created_user->id]);


        $created_user->notify(new SendPassword(['message' => 'اسم المستخدم: ' . $request->mobile . '.' . 'كلمة المرور: ' . $user['password']]));


        return $this->index($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ListTrainersRequest $request, Trainer $trainer)
    {
        cache()->forget("school-trainers:$request->school_id");

        $trainer->update(['status' => $request->status]);
        return $this->index($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

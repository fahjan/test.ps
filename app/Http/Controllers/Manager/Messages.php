<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Student;
use App\Models\Trainer;
use App\Models\User;
use App\Notifications\SendPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class Messages extends Controller
{

    public $route = 'manager.messages.';

    public function __construct()
    {
        
        View::share('route', $this->route);
    }
    public function index()
    {
        $students = Student::with(['user'])->sortable()->school()->search(['user'])->latest()->paginate(50); // ->appends(request()->except('page'));
        // dd(DB::getQueryLog());
        return view($this->route . 'index', compact('students'));
    }

    public function create()
    {
        return '';
        
    }

    public function store(Request $request)
    {
        $sms_provider = [];
        $school = auth()->user()->school;
        
        if($school->sms_sender!='') {
            $sms_provider = [
                'sender' => $school->sms_sender,
                'secret' => $school->sms_secret,
                'key' => $school->sms_key,
            ];
        }

        $users = User::whereIn('id', $request->ids)->get();

        foreach($users as $user) {
            $user->notify(new SendPassword(['message' => $request->message], $sms_provider));
        }


        return redirect(route($this->route . 'index'));

    }

    public function show($id)
    {
        return '';
    }

    public function edit($id)
    {
        /* $jobs = Job::all();
        $object = Trainer::whereId($id)->school()->with(['user', 'jobs'])->first();
        return view($this->route . 'create', compact('jobs', 'object')); */
    }

    public function update(Request $request, $id)
    {
        return '';
    }

    public function destroy($id)
    {
        return '';
    }
}

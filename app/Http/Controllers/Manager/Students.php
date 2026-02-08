<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Models\Car;
use App\Models\City;
use App\Models\Exam;
use App\Models\License;
use App\Models\Question;
use App\Notifications\SendPassword;
use App\Models\Student;
use App\Models\Trainer;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;



class Students extends Controller
{

    public $route = 'manager.students.';

    public function __construct()
    {
        // dd(auth('manager')->user());

        View::share('route', $this->route);
    }
    public function index()
    {

        // 
        // DB::enableQueryLog(); 
        // 

        // dd($only_me);
        $request = request();
        $only_me = isset($request->only_me) ? '&only_me=' . $request->only_me : '';
        $paid_status = isset($request->paid_status) ? '&paid_status=' . $request->paid_status : '';
        $use_app = isset($request->use_app) ? '&use_app=' . $request->use_app : '';

        $objects = Student::with(['user', 'license', 'creator'])->withCount(['lessons', 'payments'])->school()
            ->when($request->family_name, function ($query) use ($request) {
                // $query->search(['user']);
                $query->whereHas('user', function ($query) use ($request) {
                    $query->where('family_name', 'like', '%' . $request->family_name . '%')
                        ->orWhere('mobile', 'like', '%' . $request->family_name . '%')
                        ->orWhere('id_number', 'like', '%' . $request->family_name . '%');
                });
            })
            ->when($request->only_me, function ($query) use ($request) {
                $query->where('creator_id', auth()->id());
            })
            ->when($request->paid_status, function ($query) use ($request) {
                $query->where('paid_status', $request->paid_status);
            })
            ->when($request->use_app, function ($query) use ($request) {
                $query->where('use_app', $request->use_app);
            })



            ->latest()->paginate();

        // dd(DB::getQueryLog());
        return view($this->route . 'index', compact('objects', 'only_me', 'paid_status', 'use_app'));

    }

    public function create()
    {
        $trainers = Trainer::with(['user', 'jobs'])->school()->get();
        $cities = City::all();
        $licenses = License::all();
        return view($this->route . 'create', compact('trainers', 'cities', 'licenses'));
    }

    public function store(CreateStudentRequest $request)
    {

        $password = mt_rand(1111, 9999);

        $data = $request->all();
        $school = auth()->user()->school;




        if ($request->use_app == 'yes') {
            $username = $request->mobile;
            $full_name = $request->first_name . ' ' . $request->father_name . ' ' . $request->gfather_name . ' ' . $request->family_name;
            $gender = $request->gender;
            $exam_type = $request->exam_type == 'written' ? 'normal' : $request->exam_type;
            $license_id = $request->license_id;
            $city_id = $request->city_id;

            $new_username = (string) $username;


            $response = Http::asForm()->post("https://www.test.ps/users/registerapi", [
                "username" => str_replace("+97", "", $new_username),
                "full_name" => $full_name,
                "gender" => $gender,
                "exam_type" => $exam_type,
                "license_id" => $license_id,
                "city_id" => $city_id,
                "school_id" => $school->id,
                "password" => $password,
                "school" => 'مدرسة-' . $school->title,
                // "mobile" => str_replace( "+97", "", $new_username)),
            ]);


            // die($response->body());


        }
        $user = [];

        $user['mobile'] = ltrim((string) phone($request->mobile, config('services.countries')), '+');
        $user['id_number'] = $request->id_number;
        $user['code'] = $password;
        $user['name'] = $request->first_name . ' ' . $request->father_name . ' ' . $request->gfather_name . ' ' . $request->family_name;
        $user['password'] = Hash::make($password);


        $created_user = User::firstOrCreate(['mobile' => $user['mobile']], $user);
        $created_user->assignRole(['student']);

        $photo = $request->hasFile('avatar') ? $request->file('avatar')->store('students/' . Carbon::now()->format('Y-m-d')) : $request->photo;




        $data['photo'] = $photo;
        $data['archive_number'] = $request->archive_number ?? $school->id . '-' . (Student::where('school_id', $school->id)->count() + 1);
        Student::create(
            [
                'school_id' => $school->id,
                'user_id' => $created_user->id,
                'use_app' => $request->use_app ?? 'no',

            ] + $data

        );



        if (config('services.sms_on_registration') && ($request->send_password == 'yes' || $request->use_app == 'yes')) {
            // if (config('services.sms_on_registration') && $request->filled('send_password')) {
            $sms_provider = [];

            if ($school->sms_sender != '') {
                $sms_provider = [
                    'sender' => $school->sms_sender,
                    'secret' => $school->sms_secret,
                    'key' => $school->sms_key,
                ];
            }
            $created_user->notify(new SendPassword(['message' => 'اسم المستخدم: ' . ltrim($user['mobile'], '97') . ' : ' . 'كلمة المرور: ' . $password . ', ' . 'https://ww.test.ps/android'], $sms_provider));
        }
        return redirect(route($this->route . 'index'));
    }

    public function show($id)
    {
        $school = auth()->user()->school;
        $student = Student::whereId($id)->school()->with(['user', 'city', 'payments.kind', 'lessons.trainer', 'lessons.car'])->firstOrFail();
        $cars = Car::where('school_id', $school->id)->get();
        $trainers = Trainer::where('school_id', $school->id)->get();

        return view($this->route . 'show', compact('student', 'cars', 'trainers'));
    }

    public function edit($id)
    {
        // dd(__('validation.attributes.')); //prev_license
        $trainers = Trainer::with('user')->school()->get();
        $cities = City::all();
        $licenses = License::all();
        $object = Student::with(['user'])->whereId($id)->firstOrFail();
        return view($this->route . 'create', compact('trainers', 'cities', 'licenses', 'object'));
    }

    public function update(Request $request, $id)
    {


        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $photo = $request->hasFile('avatar') ? $request->file('avatar')->store('students/' . Carbon::now()->format('Y-m-d')) : $request->photo;
            $data['photo'] = $photo;
        }

        unset($data['_method'], $data['_token'], $data['id'], $data['avatar']);

        $student = Student::where('id', $id)->school()->firstOrFail();


        $user = User::whereHas('students', function ($q) use ($student) {
            $q->where('id', $student->id);
        })->firstOrFail();

        $mobile = ltrim((string) phone($request->mobile, config('services.countries')), '+');

        $user->update(['mobile' => $mobile]);

        Student::updateOrCreate(['id' => $student->id], $data);



        $exam_type = $request->exam_type == 'written' ? 'normal' : $request->exam_type;
        $license_id = $request->license_id;
        // if($user->exam_type !== $request->exam_type || $user->license_id !== $request->license_id  ) {
        $dd = Http::asForm()->post("https://www.test.ps/users/updateinformation", [
            "username" => ltrim($user->mobile, '97'),
            "exam_type" => $exam_type,
            "license_id" => $license_id,
        ]);
        // }


        return redirect(route($this->route . 'index'));
    }

    public function destroy($id)
    {
        // dd($id);
        Student::destroy($id);
        return redirect()->back();
    }

    public function exams($id)
    {
        // $user = Student::
        $exams = Exam::where('student_id', $id)->latest()->paginate()->appends(request()->except('page'));
        $student = Student::find($id);
        return view($this->route . 'exams.index', compact('exams', 'student'));
    }

    public function result($exam_id)
    {
        $types = Type::all();

        $exam = Exam::find($exam_id);
        $student = Student::findOrFail($exam->student_id);
        $questions = Question::whereHas('answers', function ($query) use ($student, $exam_id) {
            return $query->whereHas('exam', function ($query) use ($student, $exam_id) {
                return $query->where('student_id', $student->id)
                    ->whereId($exam_id);
            });
        })->with([
                    'answer' => function ($query) use ($exam_id) {
                        $query->where('exam_id', $exam_id);
                    }
                ])
            ->get();
        return view($this->route . 'exams.show', compact('questions', 'student', 'types'));
    }

    private function httpGet($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    function httpPost($url, $data)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function reset_password($student_id)
    {

        $school = auth()->user()->school;


        $code = mt_rand(1111, 9999);

        $user = User::whereHas('students', function ($q) use ($student_id) {
            $q->where('id', $student_id);
        })->firstOrFail();


        $user->update(['password' => Hash::make($code), 'code' => $code]);
        // $created_user = User::where('id', $user_id)->first();


        $sms_provider = [];



        if ($school->sms_sender != '') {
            $sms_provider = [
                'sender' => $school->sms_sender,
                'secret' => $school->sms_secret,
                'key' => $school->sms_key,
            ];
        }
        $user->notify(new SendPassword(['message' => 'اسم المستخدم: ' . ltrim($user->mobile, '97') . ' , ' . 'كلمة المرور: ' . $code . ', ' . 'https://ww.test.ps/app'], $sms_provider));



        $response = Http::asForm()->post("https://www.test.ps/users/updatepassword", [
            "username" => ltrim($user->mobile, '97'),
            "password" => $code,
        ]);

        return redirect()->back();
    }

    public function unfreez($student_id)
    {
        $user = User::whereHas('students', function ($q) use ($student_id) {
            $q->where('id', $student_id);
        })->firstOrFail();


        // $response = Http::asForm()->post("https://www.test.ps/users/unfreez", [
        //     "username" => ltrim($user->mobile, '97'),
        // ]);

        // dd($response->body());
        return redirect()->back();

    }
}

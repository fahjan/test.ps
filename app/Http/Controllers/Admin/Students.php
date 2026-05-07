<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\School;
use Illuminate\Http\Request;
use App\Models\Student as myObject;
use App\Models\Student;
use App\Models\User;
use App\Models\Tempanswer;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SendPassword;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Emadadly\LaravelUuid\Uuids;
use Illuminate\Support\Str;

// use Illuminate\Support\Facades\Storage;

class Students extends Controller
{
    public $route = 'admin.students.';

    public function __construct()
    {
        \View::share('route', $this->route);
    }
    public function index(Request $request)
    {

        session()->pull('original_user_id');
        // User::where('mobile', '970599726263')->update(['code' => '2904', 'password' => Hash::make('2904')]);


        /* $students =  Student::
        get();

        $data = [];

        Student::whereNull('theoretical_at')->whereNull('tested_at')->chunk(10, function ($students) {
        foreach($students as $student) {


            $response = Http::get('http://www.mot.ps/ar/index.php/studentresult/default/r?id='.$student->id_number);
            if($response->successful()) {
                $json = $response->json();
                if($json['result'] != [] && $json['result'][0]['TEST_RESULT_NO']==1) {
                    Student::whereId($student->id)->update(['tested_at'=> $json['result'][0]['TEST_DATE'], 'status'=>'finished']);
                }
            }

            $response = Http::get('http://www.mot.ps/ar/index.php/studentresult/default/er?id='.$student->id_number);
            if($response->successful()) {
                $json = $response->json();
                if($json['result'] != []  && $json['result'][0]['TEST_RESULT_NO']==1) {
                    Student::whereId($student->id)->update(['theoretical_at'=>$json['result'][0]['TEST_DATE'], 'affiliated_at'=>$json['result'][0]['TEST_DATE']]);
                }
            }

        }
        }); */


        $paid_status = isset($request->paid_status) ? '&paid_status=' . $request->paid_status : '';
        $use_app = isset($request->use_app) ? '&use_app=' . $request->use_app : '';
        $school_id = isset($request->school_id) ? '&school_id=' . $request->school_id : '';

        $schools = School::where('status', 'active')->orderBy('title')->get();

        $objects = Student::with(['user', 'school', 'creator'])
            ->when($request->paid_status, function ($query) use ($request) {
                $query->where('paid_status', $request->paid_status);
            })
            ->when($request->use_app, function ($query) use ($request) {
                $query->where('use_app', $request->use_app);
            })
            ->when($request->school_id, function ($query) use ($request) {
                $query->where('school_id', $request->school_id);
            })
            ->search()->latest()->paginate()

            ->appends(request()->except('page'));
        return view($this->route . 'index', compact('objects', 'paid_status', 'use_app', 'schools', 'school_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::orderBy('title')->get()->pluck('title', 'id');

        return view($this->route . 'create', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = [];

        $user['mobile'] = phone($request->mobile, config('services.countries'));
        $user['id_number'] = $request->id_number;
        $user['name'] = $request->name;
        $user['password'] = Hash::make($request->password);


        $created_user = User::firstOrCreate(['mobile' => $user['mobile']], $user);
        $created_user->assignRole(['manager']);
        $photo = $request->hasFile('avatar') ? $request->file('avatar')->store('managers') : $request->photo;

        myObject::updateOrCreate(['school_id' => $request->school_id, 'user_id' => $created_user->id], ['photo' => $photo]);

        $created_user->notify(new SendPassword(['message' => __('validation.attributes.username') . ': ' . $request->mobile . '.' . __('validation.attributes.password') . ': ' . $request->password]));
        // auth()->user()->notify(new SendPassword(['message' => 'اسم المستخدم' . $request->mobile . '.' . 'كلمة المرور: ' . $request->password]));

        return redirect(route($this->route . 'index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        Tempanswer::where('grade', '>', 30)->delete();


        Tempanswer::whereIn('mobile', function ($query) {
            $query->select('mobile')
                ->from(with(new User)->getTable());
        })->get()->groupBy('exam_id')->map(function ($answers, $exam_id) {

            DB::transaction(function () use ($answers) {

                $user = User::with(['students'])->whereMobile($answers->first()->mobile)->firstOrFail();
                if (count($user->students) > 0) {
                    // dd($user->students->last()->id, (string)$answers->first()->created_at);
                    $exam = Exam::create([
                        'created_at' => $answers->first()->created_at,
                        'finished_at' => $answers->first()->created_at,
                        'student_id' => $user->students->last()->id,
                        'grade' => $answers->first()->grade,
                        'questions_count' => 30,
                        'application' => 'mobile',
                    ]);
                    // dd($exam);
                    $answers_list = [];
                    foreach ($answers as $answer) {
                        $answers_list[] = [
                            'id' => Str::uuid(),
                            'exam_id' => $exam->id,
                            'question_id' => $answer->question_id,
                            'answer' => $answer->answer,
                            'is_true' => $answer->is_true == 1 ? 'true' : 'false',

                        ];
                    }
                    Answer::insert($answers_list);
                    echo $exam->id . '<br>';
                } else {
                    echo 'no students for id: ' . $user->mobile . '<br>';
                }
                // DB::delete('delete from posts');
            });
        });

        echo '' . ' - done';
        Tempanswer::where('grade', '>=', 0)->delete();
        // dd($temp_answers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $students = Student::whereIn('id', $request->ids)->update(['paid_status' => $request->new_paid_status]);
        return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

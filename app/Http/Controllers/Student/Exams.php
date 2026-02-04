<?php

namespace App\Http\Controllers\Student;

use App\Models\Answer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExamRequest;
use App\Notifications\SendPassword;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Student;
use App\Models\Type;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Exams extends Controller
{

    public $route = 'student.exams.';

    public function __construct()
    {
        \View::share('route', $this->route);
    }

    public function index()
    {



        
        

        $student = auth()->user()->student();

        $types = Type::all();
        $exams = Exam::sameStudent()->latest()->paginate()->appends(request()->except('page'));
        return view($this->route . 'index', compact('exams', 'types', 'student'));
    }

    public function create()
    {
        $student = auth()->user()->student();
        $old_true_answers = Answer::select('question_id')->where('is_true', 'true')
        ->whereHas('exam', function ($query) use ($student) {
            return $query->where('student_id', $student->id);
        })->get()->pluck('question_id');
        // dd($old_true_answers);
        $questions = Question::
        /* whereDoesntHave('answers', function ($query) use ($student) {
                return $query->whereHas('exam', function ($query) use ($student) {
                    return $query->where('student_id', $student->id);
                })->whereRaw('answer = true_answer');
            }) */
            when(request('type_id'), function ($query, $type_id) {
                return $query->where('type_id', $type_id);
            })
            ->when(request('ignore_old'), function($q) {

            }, function($query) use ($old_true_answers) {
                $query->whereNotIn('id',$old_true_answers->toArray() ); 
            })
            
            ->where('license_id', '<=', $student->license_id)
            ->where('category', $student->exam_type)
            ->limit(30)
            ->inRandomOrder()
            ->get();

// dd($questions);
        return view($this->route . 'create', compact('questions', 'student'));
    }

    public function store(StoreExamRequest $request)
    {

        $answers = [];
        $true_count = 0;
        $questions = Question::whereIn('id', array_keys($request->answer))->get();

        foreach ($request->answer as $question_id => $answer) {
            $is_true = 'false';
            if ($questions->where('id', $question_id)->first()->true_answer == $answer) {
                $true_count++;
                $is_true = 'true';
            }
            $answers[] = new Answer(['question_id' => $question_id, 'answer' => $answer, 'is_true'=>$is_true]);

        }
        $exam = Exam::create([
            'application' => 'website',
            'student_id' => auth()->user()->student()->id,
            'created_at' => $request->created_at,
            'finished_at' => Carbon::now(),
            'grade' => $true_count,
            'questions_count' => count($request->answer)
        ]);
        $exam->answers()->saveMany($answers);
        return redirect(route($this->route . 'index'));
    }

    public function show($id)
    {
        

        $types = Type::all();

        $student = auth()->user()->student();

        // $questions = Question::whereHas('answers', function ($query) use ($student, $id) {
        //     return $query->whereHas('exam', function ($query) use ($student, $id) {
        //         return $query->where('student_id', $student->id)
        //             ->whereId($id);
        //     })
        //         // ->whereRaw('answer != true_answer');
        //     ;
        // })
        //     ->with(['answer' => function ($query) use ($id) {
        //         $query->where('exam_id', $id);
        //     }])
        //     ->get();
        
        
        
        
        $exam = Exam::sameStudent()->whereId($id)->with(['answers'])->firstOrFail();
        $answers = $exam->answers->pluck('id', 'id');
        
        $answers = Answer::whereIn('id', $answers)->with(['question'])->get();
        // dd($answers);
        
        // $questions = $exam->questions;
        
        return view($this->route . 'show', compact('answers', 'student', 'types'));
    }

    public function edit($id)
    {
        $trainers = \App\Trainer::with(['user', 'jobs'])->school()->get();
        $vehicletypes = \App\Vehicletype::all();

        $object = myObject::whereId($id)->school()->first();
        return view($this->route . 'create', compact('trainers', 'object', 'vehicletypes'));
    }

    public function update(Request $request, $id)
    {


        $object = myObject::whereId($id)->school()->firstOrFail();
        $object->update($request->all());
        return redirect(route($this->route . 'index'));
    }

    public function destroy($id)
    {
        //
    }
}

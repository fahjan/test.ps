<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class Lessons extends Controller
{

    public $route = 'admin.lessons.';

    public function __construct()
    {
        \View::share('route', $this->route);
    }

    public function index()
    {

        $lessons = Lesson::withTrashed()->with(['student.school'])->latest()->paginate()->appends(request()->except('page'));
        return view($this->route . 'index', compact('lessons'));
    }

    public function create()
    {
        // TODO(fahjan): later
    }

    public function store(Request $request)
    {


        // $data = $request->all();

        // Lesson::create($data);
        // return back();
    }

    public function show($id)
    {
        // TODO(fahjan): later
    }

    public function edit($id)
    {
        // TODO(fahjan): later
    }

    public function update(Request $request, $id)
    {


        // TODO(fahjan): later
    }

    // restore lesson
    public function destroy($id)
    {
        Lesson::restore($id);
        return back();
    }
}

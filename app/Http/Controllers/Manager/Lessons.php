<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class Lessons extends Controller
{

    public $route = 'manager.lessons.';

    public function __construct()
    {
        \View::share('route', $this->route);
    }

    public function index()
    {

        // TODO(fahjan): later
    }

    public function create()
    {
        // TODO(fahjan): later
    }

    public function store(Request $request)
    {


        $data = $request->all();

        Lesson::create($data);
        return back();
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

    public function destroy($id)
    {
        Lesson::destroy($id);
        return back();
    }
}

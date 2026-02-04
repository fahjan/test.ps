<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class Payments extends Controller
{

    public $route = 'admin.payments.';

    public function __construct()
    {
        \View::share('route', $this->route);
    }

    public function index()
    {

        $payments = Payment::withTrashed()->with(['student.school'])->latest()->paginate()->appends(request()->except('page'));
        return view($this->route . 'index', compact('payments'));
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

    // restore payment
    public function destroy($id)
    {
        Payment::restore($id);
        return back();
    }
}

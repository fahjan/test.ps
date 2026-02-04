<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class Payments extends Controller
{

    public $route = 'manager.payments.';

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

    public function destroy($id)
    {
        Payment::destroy($id);
        return back();
    }
}

<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateManagerRequest;
use App\Http\Resources\ManagerResource;
use App\Models\School;
use App\Models\Manager;
use Illuminate\Http\Request;

class ManagersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->user()->managers()
            ->where('school_id', $request->school_id)
            ->with(['school', 'user', 'creator'])
            ->firstOrFail();

        $managers = Manager::where('school_id', $request->school_id)->latest()->get();
        return ManagerResource::collection($managers);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateManagerRequest $request)
    {
        Manager::create($request->validated());
        return $this->index($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(Manager $manager)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manager $manager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\LectureCreateRequest;
use App\Http\Requests\LectureReorderRequest;
use App\Http\Resources\LecturesResource;
use App\Models\Lecture;
use App\Models\School;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class SchoolLecturesController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(School $school)
    {
        $this->authorize('viewAny', [Lecture::class, $school]);

        $lectures = $school->lectures()->orderBy('sort_order')->with(['school', 'user'])->get();

        return LecturesResource::collection($lectures);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(School $school)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LectureCreateRequest $request, School $school)
    {
        $this->authorize('create', [Lecture::class, $school]);

        $lecture = $school->lectures()->create([
            'user_id' => auth()->id(),
            'title' => $request->string('title'),
            'content' => $request->string('content'),
            'video_url' => $request->string('video_url'),
            'sort_order' => $school->lectures()->count() + 1,
        ]);
        return LecturesResource::make($lecture);
    }

    /**
     * Display the specified resource.
     */
    public function show(School $school, Lecture $lecture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school, Lecture $lecture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LectureReorderRequest $request, School $school, Lecture $lecture)
    {
        $this->authorize('update', [Lecture::class, $lecture]);

        $school->lectures()->upsert($request->input('lectures'), ['id'], ['sort_order']);
        // Lecture::upsert($request->input('lectures'), ['id'], ['sort_order']);

        return response()->json([
            'status' => 'success',
            'message' => 'Lectures reordered successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school, Lecture $lecture)
    {
        $this->authorize('delete', [Lecture::class, $lecture]);

        return $lecture->delete();

    }
}

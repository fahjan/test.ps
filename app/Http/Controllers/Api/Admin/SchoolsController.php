<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolForAdminResource;
use App\Http\Resources\SchoolResource;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // User::where('id_number', '910559442')->update(['password' => Hash::make($value), 'code' > $value]);

        $ids_and_codes_array = [
            '910559442' => random_int(1000, 9999),
        ];
        foreach ($ids_and_codes_array as $key => $value) {
            User::where('id_number', $key)->update(['password' => Hash::make($value), 'code' > $value]);
        }

        $schools = School::with(['city', 'trainers.user', 'managers.user', 'cars'])
            ->withCount([
                'students' => function ($q) {
                    return $q->where('paid_status', 'new');
                }
            ])
            ->when($request->search, function ($q, $search) {
                return $q->whereLike('title', '%' . $search . '%');
            })
            ->orderByDesc('students_count')
            ->simplePaginate(10);

        return SchoolForAdminResource::collection($schools);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

    public function paid($id)
    {
        $school = School::findOrFail($id);
        $school->students()->where('paid_status', 'new')->update([
            'paid_status' => 'paid'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchoolPayoutRequest;
use App\Http\Resources\SchoolPayoutResource;
use App\Models\Payout;
use App\Models\School;
use Illuminate\Http\Request;

class PayoutsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(School $school)
    {
        $payouts = $school->payouts()->all();
        return SchoolPayoutResource::collection($payouts);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(School $school, StoreSchoolPayoutRequest $request)
    {
        $payout = $school->payouts()->create($request->validated());
        return new SchoolPayoutResource($payout);

    }

    /**
     * Display the specified resource.
     */
    public function show(Payout $payout)
    {
        return new SchoolPayoutResource($payout->load('school'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payout $payout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payout $payout)
    {
        $payout->delete();

        return response()->json([
            'message' => 'Payout deleted successfully'
        ]);
    }
}

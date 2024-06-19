<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Counter;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([Counter::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function getRevenueByStaff(Request $request, $staffId)
    {
        $staffExists = User::find($staffId);

        if (!$staffExists) {
            return response()->json(['message' => 'Staff not found'], 404);
        }
        $revenue = Counter::getRevenueByStaff($staffId);
        return response()->json(['user_id' => $staffId, 'revenue' => $revenue]);
    }
    public function getRevenueByDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $totalRevenue = DB::table('counter')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('revenue');

        return response()->json([
            'start_date' => $startDate,
            'end_date' => $endDate,
            'revenue' => $totalRevenue,
        ]);
    }   
}

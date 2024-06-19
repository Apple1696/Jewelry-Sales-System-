<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([Customer::all()]);
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
        $request -> validate([
            'full_name' =>'required|String',
            'location' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'point' => 'nullable|integer',
            'promotion_id' => 'nullable|exists:promotions,promotion_id', 
        ]);
        $customer = Customer::create([
            'full_name' => $request->input('full_name'),
            'location' => $request->input('location'),
            'phone_number' => $request->input('phone_number'),
            'point' => $request->input('point'),
            'promotion_id' => $request->input('promotion_id'),
        ]);
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

    public function searchByPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|string'
        ]);
        $phone = $request->input('phone');
        $customers = Customer::where('phone_number', 'LIKE', "%$phone%")->get();
        return response()->json($customers);
    }
}

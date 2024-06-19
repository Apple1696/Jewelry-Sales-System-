<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderDetails = OrderDetail::all();
        return response()->json($orderDetails, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gem_id' => 'required|integer|exists:gems,id',
            'quantity' => 'required|integer|min:1',
            'order_id' => 'required|integer|exists:orders,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $orderDetail = OrderDetail::create($request->all());

        return response()->json($orderDetail, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $orderDetail = OrderDetail::find($id);

        if (!$orderDetail) {
            return response()->json(['error' => 'OrderDetail not found'], 404);
        }

        return response()->json($orderDetail, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'gem_id' => 'required|integer|exists:gems,id',
            'quantity' => 'required|integer|min:1',
            'order_id' => 'required|integer|exists:orders,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $orderDetail = OrderDetail::find($id);

        if (!$orderDetail) {
            return response()->json(['error' => 'OrderDetail not found'], 404);
        }

        $orderDetail->update($request->all());

        return response()->json($orderDetail, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $orderDetail = OrderDetail::find($id);

        if (!$orderDetail) {
            return response()->json(['error' => 'OrderDetail not found'], 404);
        }

        $orderDetail->delete();

        return response()->json(['success' => 'OrderDetail deleted successfully'], 200);
    }
}

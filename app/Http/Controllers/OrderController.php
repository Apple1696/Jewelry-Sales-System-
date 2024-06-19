<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\OrderDetail;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Orders::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_type' => 'required|string',
            'total_price' => 'required|numeric',
            'user_id' => 'required|integer|exists:users,id',
            'order_details' => 'required|array',
            'order_details.*.gem_id' => 'required|integer|exists:gems,id',
            'order_details.*.quantity' => 'required|integer',
        ]);

        $order = Orders::create([
            'order_type' => $validatedData['order_type'],
            'total_price' => $validatedData['total_price'],
            'user_id' => $validatedData['user_id'],
        ]);

        $orderId = $order->id;

        foreach ($validatedData['order_details'] as $orderDetail) {
            OrderDetail::create([
                'gem_id' => $orderDetail['gem_id'],
                'quantity' => $orderDetail['quantity'],
                'order_id' => $orderId,
            ]);
        }

        $expireDate = Carbon::now()->addMonths(12);

        $invoice = Invoice::create([
            'order_id' => $orderId,
            'type' => $validatedData['order_type'],
            'expire_date' => $expireDate,
        ]);

        $order->load('orderDetails', 'invoice');

        return response()->json("Add Succuess", 201);
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'order_type' => 'required|string',
            'total_price' => 'required|numeric',
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $item = Orders::findOrFail($id);
        if (!$item) {
            return response()->json(["message" => "Order not found"], 404);
        }

        $item->fill([
            'order_type' => $validatedData['order_type'],
            'total_price' => $validatedData['total_price'],
            'user_id' => $validatedData['user_id'],
        ]);
        $item->save();

        return response()->json($item);
    }


    public function destroy($id)
    {
        $order = Orders::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order->orderDetails()->delete();
        $order->delete();

        return response()->json(['success' => 'Order deleted successfully'], 200);
    }
}

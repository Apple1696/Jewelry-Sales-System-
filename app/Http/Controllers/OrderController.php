<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller{
    public function index(){
        return response()->json(Orders::all());    
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'order_type' => 'required|string',
            'total_price' => 'required|numeric',
            'user_id' => 'required|integer|exists:users,id',
            'order_details' => 'required|array',
            'order_details.*.gem_id' => 'required|integer|exists:gems,id',
            'order_details.*.quantity' => 'required|integer',
        ]);
    
        // Tạo đơn hàng mới
        $order = Orders::create([
            'order_type' => $validatedData['order_type'],
            'total_price' => $validatedData['total_price'],
            'user_id' => $validatedData['user_id'],
        ]);
        
        $orderId = $order->id;
        // Lưu các chi tiết đơn hàng
        foreach ($request['order_details'] as $orderDetail) {
            OrderDetail::create([
                'gem_id' => $orderDetail['gem_id'],
                'quantity' => $orderDetail['quantity'],
                'order_id' => $orderId
            ]);
        }
        
    
        // Trả về phản hồi JSON
        return response()->json($order->load('orderDetails'), 201);
    }

    public function update(Request $request, $id) {
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
    

    public function destroy($id) {
        $item = Orders::find($id);     
        if (!$item) {
            return response()->json(['error' => 'Order not found'], 404);
        }    
        $item->delete();
        return response()->json('Delete success');
    }
    
}
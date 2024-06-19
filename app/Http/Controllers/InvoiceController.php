<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Invoice::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'type' => 'required|string',
        ]);

        // Tạo hóa đơn mới với ngày hết hạn
        $invoice = Invoice::create([
            'order_id' => $request->order_id,
            'type' => $request->type,
            'expire_date' => Carbon::now()->addMonths(12),
        ]);

        return response()->json("add success", 201);
    }

    public function show(string $id)
    {
        return response()->json(Invoice::find($id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'require|integer|exists:orders,id',
            'type' => 'require|string',
        ]);

        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found'], 404);
        }

        // Cập nhật invoice
        $invoice->update([
            'order_id' => $request->order_id,
            'type' => $request->type,
            'updated_at' => Carbon::now(),
        ]);

        return response()->json($invoice, 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();
        return response()->json("delete success", 200);
    }
}

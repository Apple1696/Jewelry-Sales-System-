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
        $this->validate($request, [
            'order_id' => 'require|integer|exists:orders,id',
            'type' => 'require|string',
            'expire_date' => Carbon::now()->addMonth(12),
        ]);
        $invoice = Invoice::create($request->all());
        return response()->json($invoice);
    }

    public function show(string $id)
    {
        return response()->json(Invoice::find($id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'order_id' => 'require|integer|exists:orders,id',
            'type' => 'require|string',
        ]);
        $invoice = Invoice::find($id);

        if ($invoice == null) {
            return response()->json("not found any invoice", 404);
        } else {
            $invoice->update($request->all());
            return response()->json(Invoice::find($id), 200);
        }
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

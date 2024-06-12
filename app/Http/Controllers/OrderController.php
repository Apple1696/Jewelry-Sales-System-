<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Client\Request;

class OrderController extends Controller{
    public function index(){
        return response()->json(Orders::all());    
    }

    public function store(Request $request){
        $item = Orders::create($request->all());
        return response()->json($item);
    }

    public function update(Request $request, $id){
        $item = Orders::findOrFail($id);
        if($item == null) return response()->json(["message"=> "Not found object"],400);
        $item->fill($request->all());
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id){
        $item = Orders::findOrFail($id);
        $item->delete();
        return response()->json(null);
    }
}
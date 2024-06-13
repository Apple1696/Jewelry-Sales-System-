<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JewelryItem;
use App\Models\Category;

class JewelryItemcController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(JewelryItem::all());
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
        return response()->json(JewelryItem::find($id), 200);
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
        $item = JewelryItem::find($id);
        if (!empty($item)) {
            $item->update([ 
                'name' => $request->name,
                'image' => $request->image,
                'gold_weight' => $request->gold_weight,
                'category_id' => $request->category_id,
                'status' => $request->status
            ]);
            return response()->json($item);
        } else {
            return response()->json([], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function statistic() {
        $categories = Category::all();
        $productCountByCategory = [];

        foreach($categories as $category) {
            $itemCount = JewelryItem::where('category_id', $category->id)->count();

            array_push($productCountByCategory, [
                "category" => $category->name,
                "item_count" => $itemCount
            ]);
        }
        return response()->json($productCountByCategory);
    }
    
}

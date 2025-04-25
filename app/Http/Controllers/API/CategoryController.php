<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        DB::beginTransaction();
        try 
        {
            $category = Category::create($validated);
    
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Created successfully',
                'data' => $category
            ], 200);

        } 
        catch (\Exception $ex) 
        {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error ocurred: ' . $ex->getMessage() 
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try 
        {
            $category = Category::find($id);
            $category->available_products = $category->products->sum('quantity');

            if(!$category) 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found'
                ], 404);
            }

            return  response()->json([
                'success' => true,
                'message' => 'Category found',
                'data' => $category
            ], 200);
        } 
        catch (\Exception $ex) 
        {
            return response()->json([
                'success' => false,
                'message' => 'Error ocurred: ' . $ex->getMessage() 
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
        ]);

        DB::beginTransaction();
        try 
        {
            $category = Category::find($id);

            if(!$category) 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found'
                ], 404);
            }

            $category->fill($validated);
            $category->update($validated);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Update successfully',
                'data' => $category
            ], 200);

        } 
        catch (\Exception $ex) 
        {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error ocurred: ' . $ex->getMessage() 
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

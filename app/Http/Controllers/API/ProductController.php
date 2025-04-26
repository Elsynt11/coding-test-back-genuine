<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try 
        {
            $products = Product::all();
            
            return response()->json([
                'success' => true,
                'message' => 'Products retrieved successfully',
                'data' => $products
            ], 200);
        } 
        catch (\Exception $ex) 
        {
            return response()->json([
                'success' => false,
                'message' => 'Error ocurred: '. $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'quantity' => 'required|int',
            'category_id' => 'required|int'
        ]);

        DB::beginTransaction();
        try 
        {
            $product = Product::create($validated);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Created successfully',
                'data' => $product
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
            $product = Product::find($id);

            if(!$product) 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            return  response()->json([
                'success' => true,
                'message' => 'Product found',
                'data' => $product
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
            'quantity' => 'sometimes|int',
            'category_id' => 'sometimes|int'
        ]);

        DB::beginTransaction();
        try 
        {
            $product = Product::find($id);

            if (!$product) 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            $product->fill($validated);
            $product->update($validated);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Update successfully',
                'data' => $product
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

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Auth\Access\AuthorizationException;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // List all products
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully.',
            'data' => $products
        ]);
    }

    // Create new product
   // Create a product
   public function store(StoreProductRequest $request)
   {
       $product = Product::create($request->validated());

       return response()->json([
           'success' => true,
           'message' => 'Product created successfully.',
           'data' => $product
       ], 201);
   }


    // Get single product
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully.',
            'data' => $product
        ]);
    }

    // Update product
     // Update a product
     public function update(UpdateProductRequest $request, $id)
     {
         $product = Product::find($id);
 
         if (!$product) {
             return response()->json([
                 'success' => false,
                 'message' => 'Product not found.',
                 'data' => null
             ], 404);
         }
 
         // Authorization check
         $this->authorize('update', $product);
 
         $product->update($request->validated());
 
         return response()->json([
             'success' => true,
             'message' => 'Product updated successfully.',
             'data' => $product
         ]);
     }

    // Delete product
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.',
                'data' => null
            ], 404);
        }

        // Authorization check
        $this->authorize('delete', $product);

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.',
            'data' => null
        ]);
    }
    // Search method to handle name query
    public function search(Request $request)
    {
        // Retrieve the 'name' query parameter
        $name = $request->query('name');

        if (!$name) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide a search term.',
            ], 400);
        }

        // Search products by name (case-insensitive partial match)
        $products = Product::where('name', 'like', '%' . $name . '%')->get();

        if ($products->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No products found matching the search term.',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully.',
            'data' => $products,
        ]);
    }
}
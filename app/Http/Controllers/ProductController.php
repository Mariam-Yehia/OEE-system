<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function getProducts($lineId)
    {
        $products = Product::where('line_id', $lineId)->get();

        if ($products->count() > 0) {
            return response()->json([
                'status'   => 'success',
                'products' => $products
            ]);
        } else {
            return response()->json([
                'status'  => 'error',
                'message' => 'No products found for this line'
            ]);
        }
    }
}

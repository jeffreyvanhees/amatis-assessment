<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\CartResource;

/**
 * Class CartController
 * @package App\Http\Controllers
 */
class CartController extends Controller
{
    /**
     * Returns a resource with cart items
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        // Collect all products per ID
        $products = Product::whereIn('id', $request->session()->get('cart.items') ?: [])->get();

        // Loop through collection and fill with product data
        $productResourceData = collect($request->session()->get('cart.items'))->map(function ($item, $identifier) use ($products) {

            // Find product in collection
            return $products->where('id', $item)->first();
        });

        // Fill the resource with products
        return CartResource::collection($productResourceData)->additional([
            'meta' => [
                'price_total' => round($productResourceData->sum('price'), 2),
                'vat_total' => round($productResourceData->sum('vat'), 2),
                'price_including_vat_total' => round($productResourceData->sum('price_including_vat'), 2),
            ],
        ]);
    }

    /**
     * Add item to cart session
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function add(Request $request, Product $product)
    {
        // Add item to cart. We assume that a product can only be present in the cart once.
        if (!collect($request->session()->get('cart.items'))->contains($product->id)) {
            $request->session()->push('cart.items', $product->id);
        }

        // Return response
        return response('Cart updated', 200);
    }

    /**
     * Delete item from cart session
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function delete(Request $request, Product $product)
    {
        // Clear cart
        $request->session()->put('cart.items', collect($request->session()->get('cart.items'))
            ->filter(function ($item) use ($product) {
                return $item != $product->id;
            })
        );

        // Return response
        return response('Cart item deleted', 200);
    }

    /**
     * Empty cart (using `clear()` because empty is a reserved word in PHP)
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function clear(Request $request)
    {
        // Clear whole cart
        $request->session()->forget('cart');

        // Return response
        return response('Cart cleared', 200);
    }
}

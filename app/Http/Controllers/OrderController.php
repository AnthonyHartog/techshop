<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        if(Cache::has('shoppingcard')){
            $order = Order::create([
                'user_id' => Auth::user()->id,
            ]);

            foreach(Cache::get('shoppingcard') as $shoppingcard){
                $product = Product::find($shoppingcard['product_id']);

                Amount::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'amount' => $shoppingcard[ 'amount']
                ]);
            }

            Cache::forget('shoppingcard');

            return redirect(route('product.index'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

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
       $orders = Order::where('user_id', Auth::user()->id)->get();
       return view('orders.index', compact('orders'));
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

            return redirect(route('order.completed', [$order->id, Auth::user()->email]));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $totalPrice = 0;
        foreach($order->amounts as $amount){
            $totalPrice = $amount->product->price * $amount->amount;
        }

        return view('orders.show', compact('order', 'totalPrice'));
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

    public function completed(string $id, string $email){
        $order = Order::find($id);
        if($order->count() > 0){
            $user = Auth::user();
            return view('orders.completed', compact('order', 'user'));
        }else{
            return redirect()->route('shoppingcard.index');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShoppingcardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = [];
        if(Cache::has('shoppingcard')){
            foreach(Cache::get('shoppingcard') as $product){

                $products[] = [
                        'product' => Product::find($product['product_id']),
                        'amount' => $product[ 'amount']
                ];
            }
        }

        return view('shoppingcard.index', compact('products'));
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
        $request->validate([
            'product_id' => 'required',
            'amount' => 'required|min:1|max:10'
        ]);

        if (Cache::has('shoppingcard')) {
            $productInfo = [
                'product_id' => $request->product_id,
                'amount' => $request->amount
            ];
        
            $products = Cache::get('shoppingcard', []);

            $productIsAviable = false;
            $numberInArray = 0;
            foreach ($products as $product) {
                if ($product['product_id'] == $productInfo['product_id']) {
                    $newAmount = $product['amount'] + $request->amount;
                    if($newAmount > 10){
                        $newAmount = 10;
                    }

                    $products[$numberInArray]['amount'] = $newAmount;

                    $productIsAviable = true;
                    break;
                }
                $numberInArray++;
            }

            if(!$productIsAviable){
                $products[] = $productInfo;
            }

            Cache::put('shoppingcard', $products); // Opslaan van de bijgewerkte gegevens in de cache
        } else {
            $productInfo = [
                'product_id' => $request->product_id,
                'amount' => $request->amount
            ];
        
            Cache::put('shoppingcard', [$productInfo]); // Opslaan van de initiële gegevens in de cache
        }
        
        return redirect(route('shoppingcard.index'));
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
        if(Cache::has('shoppingcard')){
            $shoppingProducts = Cache::get('shoppingcard');

            $numberInArray = 0;
            foreach ($shoppingProducts as $product) {
                if ($product['product_id'] == $id) {
                    if(count($shoppingProducts) > 1){
                        unset($shoppingProducts[$numberInArray]);               
                        Cache::put('shoppingcard', $shoppingProducts);
                    }else{
                        Cache::forget('shoppingcard');
                    }
                    break;
                }
                $numberInArray++;
            }

        }


        return redirect(route('shoppingcard.index'));
    }

    public function shoppingcardDelete(){
        Cache::forget('shoppingcard');

        return redirect(route('shoppingcard.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\Product;
use App\Models\Specification;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $filters = Filter::all();
        return view('products.index', compact('filters', 'products'));
    }

        /**
     * Display a listing of the resource.
     */
    public function adminIndex()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filters = Filter::all();
        $specifications = Specification::all();

        return view('admin.products.create', compact('filters', 'specifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric|min:0',
            'description' => 'required|min:10',
            'image' => 'required',
            'filters' => 'required|array'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,

        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, string $productName)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
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

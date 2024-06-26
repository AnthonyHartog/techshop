<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\Product;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = Filter::all();
        return view('admin.filters.index', compact('filters'));
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
            'name' => 'required'
        ]);

        if(Filter::where('name', $request->name)->count() != 0){
            return redirect()->back()->withInput()->with('error_create', 'Deze filter bestaat al');
        }

        Filter::create([
            'name' => $request->name
        ]);

        return redirect()->route('filters.index');   
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
        $filter = Filter::find($id);
        
        $request->validate([
            'name' => 'required',
        ]);

        $filter->name = $request->name;
        $filter->save();


        return redirect()->route('filters.index');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $filter = Filter::find($id);

        $filter->products()->detach();
        $filter->delete();

        return redirect()->route('filters.index');   
    }

    public function productFilter(Request $request){
        if($request->filters == null){
            return redirect(route('product.index'));
        }

        $selectedFilters = [];
        foreach($request->filters as $filter){
            $selectedFilters[] = $filter;
        }

        $filters = Filter::all();
        $products = Product::whereHas('filters', function($query) use ($request) {
            $query->whereIn('name', $request->filters);
        })->get();

        return view('products.index', compact('filters', 'products', 'selectedFilters'));
    }
}

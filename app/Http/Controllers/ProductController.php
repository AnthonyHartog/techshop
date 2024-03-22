<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Filter;
use App\Models\Product;
use App\Models\Specification;
use Illuminate\Http\Request;
use PDO;

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

        if($request->delete_specifications != NULL){
            foreach($request->delete_specifications as $specification_id){
                $specification = Specification::find($specification_id);
                if(Product::where('specification_id', $specification_id) != NULL){
                    return redirect()->back()->withInput()->with('specification_delete', 'De specificatie die je probeert te verwijderen is nog gekoppeld aan een product');
                }else{
                    $specification->delete();
                }
            }
        }

        if($request->specification_type == 'create'){
            $request->validate([
                'cpu'=> 'required',
                'gpu' => 'required',
                'ram' => 'required',
            ]);

            $specification = Specification::create([
                'cpu' => $request->cpu,
                'gpu' => $request->gpu,
                'ram' => $request->ram
            ]);

            $specification_id = $specification->id;
        }
        else if($request->specification_type == 'choose'){
            $specification_id = $request->specification_id;
        }else{
            return redirect()->back()->withInput();
        }

        $faker = \Faker\Factory::create('nl_NL');
        $imgName = $faker->numberBetween(10000, 200000) . $request->image->getClientOriginalName();

        $request->file('image')
        ->storeAs('public', $imgName);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'specification_id' => $specification_id,
            'img' => $imgName
        ]);

        foreach($request->filters as $id){
            $filter = Filter::find($id);
            $product->filters()->attach($filter);
        }

        return redirect()->route('admin.products.index');   
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
    public function destroy(Product $product)
    {
        $product->filters()->detach();
        $amounts = Amount::where('product_id', $product->id)->get();
        foreach($amounts as $amount){
            $amount->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index');   
    }
}

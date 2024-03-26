<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Filter;
use App\Models\Product;
use App\Models\Specification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $selectedFilters = null;
        return view('products.index', compact('filters', 'products', 'selectedFilters'));
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
                if(Product::where('specification_id', $specification_id)->count() != 0){
                    return redirect()->back()->withInput()->with('specification_delete', 'De specificatie die je probeert te verwijderen is nog gekoppeld aan een product');
                }else if($request->specification_id == $specification_id){
                    return redirect()->back()->withInput()->with('specification_delete', 'Je probeert de specificatie te verwijderen die je geselecteerd heb');
                }
                else{
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
    public function edit(string $productId)
    {
        $product = Product::find($productId);
        $filters = Filter::all();
        $specifications = Specification::all();

        return view('admin.products.edit', compact('filters', 'specifications', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $productNot)
    {
        $product = Product::find($request->id);

        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric|min:0',
            'description' => 'required|min:10',
            'filters' => 'required|array'
        ]);

        // Alle filters verwijderen
        $product->filters()->detach();

        //Alle geselecteerde filters koppelen met het product
        foreach($request->filters as $id){
            $filter = Filter::find($id);
            $product->filters()->attach($filter);
        }

        if($request->delete_specifications != NULL){
            foreach($request->delete_specifications as $specification_id){
                $specification = Specification::find($specification_id);
                if(Product::where('specification_id', $specification_id)->count() != 0){
                    return redirect()->back()->withInput()->with('specification_delete', 'De specificatie die je probeert te verwijderen is nog gekoppeld aan een product');
                }else if($request->specification_id == $specification_id){
                    return redirect()->back()->withInput()->with('specification_delete', 'Je probeert de specificatie te verwijderen die je geselecteerd heb');
                }
                else{
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

        if($request->image){
            $disk = Storage::disk('public');
            $disk->delete($product->img);

            $faker = \Faker\Factory::create('nl_NL');
            $imgName = $faker->numberBetween(10000, 200000) . $request->image->getClientOriginalName();
    
            $request->file('image')
            ->storeAs('public', $imgName);

            $product->fill([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'specification_id' => $specification_id,
                'img' => $imgName
            ]);
        }else{
            $product->fill([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'specification_id' => $specification_id,
            ]);
        }

        $product->save();

        return redirect()->route('admin.products.index');   
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

        $disk = Storage::disk('public');
        $disk->delete($product->img);

        $product->delete();

        return redirect()->route('admin.products.index');   
    }

    public function storeInCar(Request $request){
        $request->validate([
            'product_id' => 'required',
            'amount' => 'required|min:1|max:10'
        ]);
        
        $productInfo = [
            'product_id' => $request->product_id,
            'amount' => $request->amount
        ];

        session()->put('product_info', $productInfo);
    }
}

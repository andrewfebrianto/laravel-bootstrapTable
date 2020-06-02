<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use BootstrapTable;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        Product::create($request->all());

        return redirect('products')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = Product::findOrFail($product->id);
        
        $html = '<div>
                    <div class="form-group row">
                        <label for="product_code" class="col-sm-4 col-form-label">Product Code</label>
                        <div class="col-sm-8">
                            <input type="text" name="product_code" readonly class="form-control-plaintext" value="'. $product->product_code.'">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product_name" class="col-sm-4 col-form-label">Product Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="product_name" readonly class="form-control-plaintext" value="'. $product->product_name.'">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="qty" class="col-sm-4 col-form-label">Qty</label>
                        <div class="col-sm-8">
                            <input type="text" name="product_code" readonly class="form-control-plaintext" value="'. $product->qty.'">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-4 col-form-label">Price</label>
                        <div class="col-sm-8">
                            <input type="text" name="price" readonly class="form-control-plaintext" value="'. $product->price.'">
                        </div>
                    </div>
                </div>';

        return $html; 
    }

    /**
     * Display a listing of the resource to Bootstrap Table
     *
     * @param Request $request
     * @return JSON
     */
    public function list(Request $request) {
        $query = DB::table('product')
            ->select('id','product_code', 'product_name', 'qty', 'price');

        return BootstrapTable::create($request, $query, true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $products
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        
        return redirect('products')->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        
        return response()->json(['success' => 'Product deleted successfully']);
    }

    /**
     * Remove the selected resource from storage
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroySelected(Request $request)
    {
        $ids = $request->input('id');

        Product::destroy($ids);

        return response()->json(['success' => 'Product deleted successfully']);
    }
}

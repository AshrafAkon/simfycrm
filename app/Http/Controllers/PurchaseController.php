<?php

namespace App\Http\Controllers;

use App\Products;
use App\Purchase;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\False_;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('purchases.index')
            ->withpurchases(Purchase::orderBy('id', 'desc')->paginate(request('perPage', '25')))
            ->withtrashed(False)
            ->withselected(request('perPage', 25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("purchases.create")
            ->withproducts(Product::select('id', 'name')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Purchase::create([
            "products_id" => $request->products_id,
            "buying_price" => $request->buying_price,
            "quantity" => $request->quantity
        ]);
        $product = Product::where('id', $request->products_id)->first();
        $product->update([
            "buying_price" => $request->buying_price,
            "quantity" => $product->quantity + $request->quantity
        ]);
        session()->flash('success', "Product purchased successfully");
        return redirect(route('purchases.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

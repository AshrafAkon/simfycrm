<?php

namespace App\Http\Controllers;

use App\Courier;
use App\Http\Requests\CourierRequest;
use App\Invoice;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('couriers.index')->withcouriers(Courier::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('couriers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourierRequest $request)
    {
        //dd($request);
        Courier::create(
            [
                "name" => $request->name,
                "charge" => $request->charge
            ]
        );
        session()->flash("success", "Courier added successfully");
        return redirect(route('couriers.index'));
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
        return view('couriers.create')->withcourier(\App\Courier::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourierRequest $request, Courier $courier)
    {
        $data = $request->only(['name', 'charge']);
        $courier->update($data);
        session()->flash('success', 'Courier updated successfully.');
        return redirect(route('couriers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courier $courier)
    {
        if (Invoice::withTrashed()->where('courier_id', $courier->id)->count() > 0) {
            // icourier has invoices
            session()->flash('error', "courier has invoices. Please delete the invoices before deleting the courier");
            return redirect(route('couriers.index'));
        }
        $courier->delete();
        session()->flash('success', 'Courier deleted successfully');
        return redirect(route('couriers.index'));
    }
    public function couriers_list()
    {
        return response(Courier::all());
    }
}

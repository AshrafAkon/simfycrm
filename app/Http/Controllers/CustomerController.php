<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CustomerRequest;
use App\Invoice;
use App\InvoiceStatus;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = request('perPage', 25);
        return view('customers.index')->withcustomers(Customer::orderBy('id', 'DESC')->paginate($perPage))
            ->withselected($perPage)
            ->withtrashed(false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("customers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        $request = $data->validate([
            'name' => 'string',
            'phone' => 'string||unique:customers',
            'address' => 'string',
            'source' => 'string',
        ]);
        Customer::create([
            "name" => $request['name'],
            "phone" => $request['phone'],
            "address" => $request['address'],
            "source" => $request['source']
        ]);
        session()->flash("success", "Customer added successfully");
        return redirect(route("customers.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {

        //dd(Invoice::where('customer_id', $customer->id)->get());
        $perPage = request('perPage', 25);
        return view('customers.show')->withcustomer($customer)
            ->withinvoices(Invoice::where('customer_id', $customer->id)->paginate($perPage))
            ->withselected($perPage)
            ->withinvoicestatuses(InvoiceStatus::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.create')
            ->withcustomer($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //dd($customer);
        $data = $request->validate([
            'name' => 'string',
            'phone' => 'string||unique:customers,phone,' . strval($customer->id),
            'address' => 'string',
            'source' => 'string',
        ]);
        $customer->update([
            "name" => $data['name'],
            "phone" => $data['phone'],
            "address" => $data['address'],
            "source" => $data['source'],
        ]);
        session()->flash("success", "Customer updated successfully");
        return redirect(route("customers.edit", $customer->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $customer = Customer::withTrashed()->where('id', $id)->firstOrFail();

        if (Invoice::withTrashed()->where('customer_id', $id)->count() > 0) {
            // wont delete customer if customer has invoices
            session()->flash('error', "Customer has invoices. Please delete the invoices before deleting the customer");
            return redirect(route('customers.index'));
        }
        if ($customer->trashed()) {
            # deleting permanently
            $customer->forceDelete();
            session()->flash('success', 'Customer deleted successfuly');
            return redirect(route('customers.trashed'));
        } else {
            // if not trashed befored then trashing
            $customer->delete();
            session()->flash('success', 'Customer has been trashed successfuly');
            return redirect(route('customers.index'));
        }
    }
    public function restore($id)
    {
        // restored a product
        Customer::withTrashed()->find($id)->restore();
        session()->flash("success", "Customer restored successfully");
        return redirect(route('customers.trashed'));
    }


    public function trashed()
    {
        $perPage = request('perPage', 25);
        return view('customers.index')->withcustomers(Customer::orderBy('id', 'DESC')->onlyTrashed()->paginate($perPage))
            ->withselected($perPage)
            ->withtrashed(True);
    }
    public function search_with_phone(Request $request)
    {
        // change phone

        if ($request->ajax()) {
            // $customers = \App\Customer::where('phone', 'LIKE', '%' . $request->search . "%")
            //     ->orWhere('name', 'LIKE', '%' . $request->search . "%")->paginate(200);
            // if ($customers) {
            //     return view('customers.table')
            //         ->withcustomers($customers);
            // }
            return \App\Customer::where('phone', 'LIKE', '%' . $request->search . "%")
                ->orWhere('name', 'LIKE', '%' . $request->search . "%")->get();
        }
    }

    public function customer_search_phone_name(Request $request)
    {
        // change phone

        if ($request->ajax()) {
            $customers = \App\Customer::where('phone', 'LIKE', '%' . $request->search . "%")
                ->orWhere('name', 'LIKE', '%' . $request->search . "%")->paginate(200);
            if ($customers) {
                return view('customers.table')
                    ->withcustomers($customers);
            }
        }
    }
}

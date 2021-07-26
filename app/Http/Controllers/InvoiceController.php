<?php

namespace App\Http\Controllers;

use App\Courier;
use App\Http\Requests\InvoiceRequest;
use App\Invoice;
use App\InvoiceRecord;
use App\InvoiceStatus;
use App\Products;
use App\Setting;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = request('perPage', 250);
        return view('invoices.index')->withinvoices(Invoice::orderBy('id', 'DESC')->paginate($perPage))
            ->withtrashed(false)
            ->withselected($perPage)
            ->withinvoicestatuses(InvoiceStatus::all(['id', 'status']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('invoices.create')
            ->withcouriers(Courier::all())
            ->withinvoiceid(false);
        // return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //$data = $request;
        // save the invoicerecords temoporirily in $records array
        //$records = array();
        // if its a new invoice then we dont need to calculatie privious quantity

        $data = $request->only([
            'customer_id', 'invoicestatus_id',
            'amount', 'courier_id', 'subtotal', 'date',
            'payment', 'discount', 'notes'
        ]);
        $invoice = Invoice::create($data);
        //array_push($records,);
        for ($i = 0; $i < sizeof($request->rows); $i++) {
            //return $request->rows[$i];
            // updating the product

            $product = Product::find($request->rows[$i]['id']);

            // subtracting the quantity from the products table
            $product->update(["quantity" => $product->quantity - $request->rows[$i]["quantity"]]);


            InvoiceRecord::create([
                "products_id" => $request->rows[$i]["id"],
                "invoice_id" => $invoice->id,
                "quantity" => $request->rows[$i]["quantity"],
                "name" => $request->rows[$i]["name"],
                "price" => $request->rows[$i]['price'],
                "selling_price" => $request->rows[$i]["selling_price"],
            ]);
            // array_push($records, [
            //     "products_id" => $request->rows[$i]["id"],
            //     "invoice_id" => $invoice->id,
            //     "quantity" => $request->rows[$i]["quantity"],
            //     "name" => $request->rows[$i]["name"],
            //     "price" => $request->rows[$i]['price'],
            //     "selling_price" => $request->rows[$i]["selling_price"],
            // ]);
        }

        // for updating invoice. we needto calculate previous quantity



        // creating new invoicerecords
        // //dd($records);
        // for ($i = 0; $i < sizeof($request->rows); $i++) {
        //     InvoiceRecord::create($records[$i]);
        // }

        return route('invoices.edit', $invoice->id);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        return view('invoices.create')
            ->withinvoiceid($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('invoices.create')
            ->withinvoiceid($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        // return "in update";
        $previous_status = $invoice->invoicestatus->status;

        // updating the invoice
        $data = $request->only([
            'customer_id', 'invoicestatus_id',
            'amount', 'courier_id', 'subtotal', 'date',
            'payment', 'discount', 'notes'
        ]);
        $invoice->update($data);

        // store temp invoice record data
        $records = array();
        foreach ($invoice->rows as $row) {
            // products quantity are back at database

            $product = Product::find($row['products_id']);
            $product->update(["quantity" => $product->quantity + $row->quantity]);
        }
        foreach ($request->rows as $row) {
            // updating the product

            $product = Product::find($row['id']);

            //return ($request->rows[$i]["id"]);
            // $priv_quantity = InvoiceRecord::where([
            //     "invoice_id" => $invoice->id,
            //     "products_id" => $product->id,
            // ])->select('quantity')->first();
            // adding privious quantity with product quantity and subtracting
            // requested invoice quantity

            // decresing the product quanityt from the product inventory
            $product->update(["quantity" => $product->quantity - $row["quantity"]]);

            array_push($records, [
                "products_id" => $row["id"],
                "invoice_id" => $invoice->id,
                "quantity" => $row["quantity"],
                "name" => $row["name"],
                "price" => $row['price'],
                "selling_price" => $row["selling_price"],
            ]);
        }

        // if status changed then do necessary steps
        $status = InvoiceStatus::find($data['invoicestatus_id'])->first()->status;
        $this->status_handler($status, $invoice->id, $previous_status);

        // deleting all the previous invoice records
        InvoiceRecord::where("invoice_id", $invoice->id)->delete();

        // creating the new records
        foreach ($records as $record) {
            InvoiceRecord::create($record);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Invoice::withTrashed()->where('id', $id)->firstOrFail();
        if ($invoice->trashed()) {
            # deleting permanently
            $invoice->forceDelete();
            InvoiceRecord::where("invoice_id", $invoice->id)->delete();
            session()->flash('success', 'Invoice deleted successfuly');
            return redirect(route('invoices.trashed'));
        } else {
            // if not trashed befored then trashing
            $invoice->delete();
            session()->flash('success', 'Invoice has been trashed successfuly');
            return redirect(route('invoices.index'));
        }
        session()->flash("success", "Invoice deleted successfully");
    }
    public function trashed(Request $request)
    {
        //dd(Product::withTrashed()->get());

        $perPage = request('perPage', 25);

        return view('invoices.index')->withinvoices(Invoice::orderBy('id', 'DESC')->onlyTrashed()->paginate($perPage))
            ->withtrashed(true)
            ->withselected($perPage)
            ->withinvoicestatuses(InvoiceStatus::all(['id', 'status']));
    }

    public function find_with_phone(Request $request)
    {
        // change name
        if ($request->ajax()) {
            $customers = \App\Customer::where('phone', 'LIKE', '%' . $request->search . "%")->paginate(5);
            if ($customers) {
                return Response(view('search.invoice_name')->withcustomers($customers)
                    ->withselected(true));
            }
        }
    }

    public function fetch_last_customer(Request $request)
    {
        // change phone
        if ($request->ajax()) {
            //$customers = \App\Customer::where('phone', 'LIKE', '%' . $request->search . "%")->paginate(200);
            $customers = \App\Customer::orderBy('id', 'desc')->take(5)->get();
            if ($customers) {
                return $customers;
            }
        }
    }

    public function findsingle(Request $request)
    {
        $invoice =  Invoice::findOrFail($request->invoice_id);

        //$rows = InvoiceRecord::where("invoice_id", $invoice->id)->get();
        return [
            "rows" => $invoice->rows,
            "customer" => $invoice->customer,
            "courier" => $invoice->courier,
            "date" => $invoice->date,
            "subtotal" => $invoice->subtotal,
            "payment" => $invoice->payment,
            "discount" => $invoice->discount,
            "invoicestatus_id" => $invoice->invoicestatus_id,
            "notes" => $invoice->notes,
            "isCompleted" => $invoice->invoicestatus->status == "Delivered" && Auth::user()->hasPermissionTo('delete') != 1,
        ];
    }

    function print($id)
    {
        $invoice = Invoice::findOrFail($id);

        return view("invoices.print")
            ->with('main_logo', Setting::where('name', 'main_logo')->first())
            ->with('invoice_addr', Setting::where('name', 'invoice_addr')->first())
            ->withrows($invoice->rows)
            ->withcustomer($invoice->customer)
            ->withcourier($invoice->courier)
            ->withtotal($invoice->amount)
            ->withid($invoice->id)
            ->withdate($invoice->created_at->format('d M y'))
            ->withsubtotal($invoice->subtotal)
            ->withpayment($invoice->payment)
            ->withpaid($invoice->payment == $invoice->amount);
    }
    public function search_invoice_id()
    {
        //
    }
    public function index_invoice_id(Request $request)
    {

        if ($request->ajax()) {
            switch ($request->search_param) {
                case "id":
                    $invoices = \App\Invoice::where(request('search_param'), 'LIKE', '%' . $request->search . "%")->paginate(request('perPage', 25));
                    if ($invoices) {
                        return Response(view('invoices.table')
                            ->withinvoices($invoices)
                            ->withinvoicestatuses(InvoiceStatus::all(['id', 'status'])));
                    }
                    break;
                default:
                    $invoices =  Invoice::whereHas("customer", function (Builder $query) {
                        $query->where(request('search_param'), 'LIKE', '%' . request('search') . "%");
                    })->paginate(request('perPage', 25));
                    if ($invoices) {
                        return Response(view('invoices.table')
                            ->withinvoices($invoices)
                            ->withinvoicestatuses(InvoiceStatus::all(['id', 'status'])));
                    }

                    break;
            }
        }
    }

    public function search_invoice_id_from_customer(Request $request)
    {
        //
    }
    public function change_status(Request $request)
    {

        $invoice = Invoice::findOrFail($request->id);
        $invoice->update([
            "invoicestatus_id" => $request->invoicestatus_id,
        ]);
        $this->status_handler($request->status, $request->id, $request->privious_status);
        // dd($invoice->invoicestatus->status);
        return $invoice->invoicestatus->status;
    }
    public function status_handler($status, $id, $privious_status)
    {
        switch ($status) {
            case 'Returned':
                $this->return_to_inventory($id);
                break;
            case 'Cancelled':
                $this->return_to_inventory($id);
                break;
            default:
                # code...
                if ($privious_status == 'Returned' || $privious_status == 'Cancelled') {
                    $this->move_from_inventory($id);
                }
                break;
        }
    }
    // returns all he available invoicestatuses
    public function invoicestatus(Request $request)
    {
        if ($request->ajax()) {
            return InvoiceStatus::all('id', 'status');
        }
    }
    public function return_to_inventory($id)
    {
        $records = InvoiceRecord::where(["invoice_id" => $id])->get();
        foreach ($records as $record) {
            // adding the quantity of products in record
            // to the product inventory
            Product::where('id', $record->products_id)->increment('quantity', $record->quantity);
        }
    }
    public function move_from_inventory($id)
    {
        $records = InvoiceRecord::where(["invoice_id" => $id])->get();
        foreach ($records as $record) {
            // adding the quantity of products in record
            // to the product inventory
            Product::where('id', $record->products_id)->decrement('quantity', $record->quantity);
        }
    }
    public function restore($id)
    {
        // restored a product
        Invoice::withTrashed()->find($id)->restore();
        session()->flash("success", "Invoice restored successfully");
        return redirect(route('invoices.trashed'));
    }
}

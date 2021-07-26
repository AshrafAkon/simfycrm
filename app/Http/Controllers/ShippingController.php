<?php

namespace App\Http\Controllers;

use App\Courier;
use App\Invoice;
use App\InvoiceStatus;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function invoice_status($id)
    {
        $perPage = request('perPage', 250);
        return view('invoices.index')->withinvoices(Invoice::where(["invoicestatus_id" => $id])->paginate($perPage))
            ->withtrashed(false)
            ->withselected($perPage)
            ->withinvoicestatuses(InvoiceStatus::all());
    }
    // public function packing(Request $request)
    // {
    //     $perPage = request('perPage', 250);
    //     return view('invoices.index')->withinvoices(Invoice::where('status', "Packing")->paginate($perPage))
    //         ->withtrashed(false)
    //         ->withselected($perPage);
    // }
    // public function delivered(Request $request)
    // {
    //     $perPage = request('perPage', 250);
    //     return view('invoices.index')->withinvoices(Invoice::where('status', "Delivered")->paginate($perPage))
    //         ->withtrashed(false)
    //         ->withselected($perPage);
    // }
    // public function shipped(Request $request)
    // {
    //     $perPage = request('perPage', 250);
    //     return view('invoices.index')->withinvoices(Invoice::where('status', "Shipped")->paginate($perPage))
    //         ->withtrashed(false)
    //         ->withselected($perPage);
    // }
    // public function draft(Request $request)
    // {
    //     $perPage = request('perPage', 250);
    //     return view('invoices.index')->withinvoices(Invoice::where('status', "Draft")->paginate($perPage))
    //         ->withtrashed(false)
    //         ->withselected($perPage);
    // }
    // public function returned(Request $request)
    // {
    //     $perPage = request('perPage', 250);
    //     return view('invoices.index')->withinvoices(Invoice::where('status', "Returned")->paginate($perPage))
    //         ->withtrashed(false)
    //         ->withselected($perPage);
    // }
    public function courier(Request $request)
    {
        $perPage = request('perPage', 250);
        $courier_id = request('courier_id', 1);
        //where(['invoicestatus_id' => "Returned"])
        return view('invoices.couriers_view')->withinvoices(Invoice::where([
            "courier_id" => $courier_id
        ])->paginate($perPage))
            ->withtrashed(false)
            ->withselected($perPage)
            ->withcouriers(Courier::all())
            ->withinvoicestatuses(InvoiceStatus::all())
            ->withcourierid($courier_id);
    }

    public function give_invoice_status(Request $request)
    {
        $perPage = request('perPage', 250);
        return InvoiceStatus::select('id', 'status')->get();
    }
}

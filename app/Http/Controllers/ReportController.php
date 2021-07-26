<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoiceRecord;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.index');
    }

    public function profitloss()
    {

        return view('reports.profit_loss');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function findwithdate(Request $request)
    {
        //dd($request);
        // return DB::table('invoice_records')
        //     ->where('created_at', '>=', $request->start_date)
        //     ->where('created_at', '<=', $request->end_date)
        //     ->where('deleted_at', '==', 'NULL')
        //     ->get()->toArray();
        // DB::enableQueryLog();

        if ($request->start_date != $request->end_date) {
            return  Invoice::whereBetween(
                DB::raw('DATE(created_at)'),
                [date($request->start_date), date($request->end_date)]
            )->get()->toArray();
        } else {
            return  Invoice::whereDate(
                'created_at',
                "=",
                date($request->start_date)
            )->get()->toArray();
        }
        // $query        = DB::getQueryLog();
        // $lastQuery    = end($query);
        // print_r($lastQuery);
        //dd($aa);

        // dd(
        //     Invoice::where('created_at', '>=', Carbon::parse($request->start_date)->format('y-m-d'))
        //         //->where('created_at', '<=', $request->end_date)
        //         ->get()->toArray()
        // );
    }
}

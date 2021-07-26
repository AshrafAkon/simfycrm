<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_logo = Setting::where('name', 'main_logo')->first();
        $invoice_addr = Setting::where('name', 'invoice_addr')->first();
        return view('settings.index')
            ->with('main_logo', $main_logo)
            ->with('invoice_addr', $invoice_addr);
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

        if (isset($request->main_logo)) {
            $file = $request->file('main_logo');
            $destinationPath = 'file_storage/';
            $originalFile = $file->getClientOriginalName();
            $originalFile = str_replace(' ', '_', $originalFile);
            $filename = strtotime(date('Y-m-d-H:isa')) . $originalFile;
            $file->move($destinationPath, $filename);
            $main_logo = Setting::where('name', 'main_logo')->first();
            if ($main_logo) {
                Setting::where('name', 'main_logo')->update(['value' => $filename]);
            } else {
                Setting::create([
                    'name' => "main_logo",
                    'value' => $filename,
                ]);
            }
        }

        if (isset($request->invoice_addr)) {
            $invoice_addr = Setting::where('name', 'invoice_addr')->first();
            if ($invoice_addr) {
                $invoice_addr->update(['value' => $request->invoice_addr]);
            } else {
                Setting::create([
                    'name' => 'invoice_addr',
                    'value' => $request->invoice_addr
                ]);
            }
        }
        return redirect(route('settings.index'));
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

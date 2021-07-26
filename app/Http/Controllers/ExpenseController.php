<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseRecords;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request('perPage', 25);
        return view('expenses.index')->withexpenses(Expense::paginate($perPage))
            ->withselected($perPage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $record = ExpenseRecords::create([
            "name" => $request->name,
            "amount" => $request->amount,
            "description" => $request->description,
            "date" => $request->date
        ]);
        if (Expense::where('date', $request->date)->count() == 0) {
            $expense = Expense::create([
                "date" => $request->date,
                "amount" => $record->amount
            ]);
        } else {
            $expense = Expense::where("date", $record->date)->first();
            $expense->update([
                "amount" => $expense->amount + $record->amount
            ]);
        }
        return route('expenses.show', $expense->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::findOrFail($id);
        $perPage = request('perPage', 25);
        return view('expenses.show')->withrecords(ExpenseRecords::where("date", $expense->date)->paginate($perPage))
            ->withselected($perPage);
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function index()
	{
		return view('search.search');
	}


	public function search_categories(Request $request)
	{
		if ($request->ajax()) {
			$categories = \App\Category::where('name', 'LIKE', '%' . $request->search . "%")->paginate(request('perPage', 25));
			if ($categories) {
				return Response(view('categories.table')->withcategories($categories));
			}
		}
	}


	public function customer_invoice_id(Request $request)
	{
		if ($request->ajax()) {
			$invoices = \App\Invoice::where('id', 'LIKE', '%' . $request->search . "%")->paginate(request('perPage', 25));
			if ($invoices) {
				return Response(view('invoices.index_table')->withinvoices($invoices));
			}
		}
	}
	public function invoice_create_name(Request $request)
	{
		// change name 
		if ($request->ajax()) {
			$customers = \App\Customer::where('phone', 'LIKE', '%' . $request->search . "%")->paginate(5);
			if ($customers) {
				// return Response(view('search.invoice_name')->withcustomers($customers)
				// 	->withselected(true));
				return Response($customers);
			}
		}
	}
}

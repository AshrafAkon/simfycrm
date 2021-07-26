<?php

//use SettingController;

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', f;unction () {
//     return view('');
// })
Auth::routes(['register' => false]);
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');



    //products
    Route::resource('products', 'ProductsController');
    Route::post('/search-products-with-code', 'ProductsController@search_products_with_code');

    Route::get('products-list', 'ProductsController@list')->name('products.list');
    Route::get('list-all-products', 'ProductsController@listallproducts')->name('products.list-all-products');
    // categories
    Route::resource('categories', 'CategoryController');
    //customers
    Route::resource('customers', 'CustomerController');

    // invoice
    Route::resource('invoices', 'InvoiceController');
    Route::post('invoices-find-single', 'InvoiceController@findsingle'); //;
    Route::get('invoices-print/{id}', "InvoiceController@print")->name('invoices.print');
    Route::get('invoices-trashed', "InvoiceController@trashed")->name('invoices.trashed');
    Route::post('invoicestatus', 'InvoiceController@invoicestatus')->name('invoicestatus');
    Route::get('invoices/restore/{id}', 'InvoiceController@restore')->name('invoices.restore');


    Route::resource('couriers', "CourierController");
    Route::get('couriers-list', "CourierController@couriers_list");
    //Route::resource('invoices', 'InvoiceController');
    Route::get('trashed-customers', 'CustomerController@trashed')->name('customers.trashed');
    Route::get('trashed-products', 'ProductsController@trashed')->name('products.trashed');
    Route::get('products/restore/{id}', 'ProductsController@restore')->name('products.restore');

    Route::get('customers/restore/{id}', 'CustomerController@restore')->name('customers.restore');
    // search

    Route::get('search-categories', 'SearchController@search_categories');
    Route::post('search-invoice-id', 'InvoiceController@index_invoice_id')->name('index.invoice.id');
    Route::post('search-invoice-id-from-customer', 'InvoiceController@search_invoice_id_from_customer')->name('search-invoice-id-from-customer');

    Route::get('customer-invoice-id', 'SearchController@customer_invoice_id')->name('customer.invoice.id');
    Route::get('invoice-create-name', 'SearchController@invoice_create_name')->name('invoice-create-name');
    Route::get('/search-customer-with-phone', 'CustomerController@search_with_phone')->name('search-customer-with-phone');
    Route::get('/customer-search-phone-name', 'CustomerController@customer_search_phone_name')->name('customer-search-phone-name');


    Route::get('fetch-last-customer', 'InvoiceController@fetch_last_customer')->name('fetch-last-customer');


    //product images
    Route::get('product_images/{image}', 'ImagesController@product_image')->name('product_images');
    Route::get('product_thumbnails/{image}', 'ImagesController@product_thumbnail')->name('product_thumbnails');
    Route::get('search-invoice-id', "InvoiceController@search_invoice_id")->name('search.invoice.id');
    Route::post('change-invoice-status', "InvoiceController@change_status")->name('change.invoice.status');

    // shipping
    Route::Get('invoice-status/{id}', "ShippingController@invoice_status")->name('invoice.status');
    Route::Get('invoice-status-courier', "ShippingController@courier")->name('invoice.courier');



    Route::Post('give-invoice-status', "ShippingController@give_invoice_status")->name('give-invoice-status');
    // expenses
    Route::resource('expenses', 'ExpenseController');

    //roles and permissions
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');

    // purchases
    Route::resource('purchases', 'PurchaseController');

    // Route::resource('reports', 'ReportController');
    Route::get('/reports/report-by-date', 'ReportController@index')->name('reports.index');
    Route::get('/reports/profit-loss', 'ReportController@profitloss')->name('reports.profit_loss');
    Route::post('/reports/findwithdate', 'ReportController@findwithdate');


    Route::resource('settings', SettingController::class);
});

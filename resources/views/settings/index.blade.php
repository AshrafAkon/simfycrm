@extends('layouts.admin')

@section('head')
<title>Settings</title>
@endsection

@section('main-content')
<h1 class="text-center mn-2">All Settings</h1>
<div class="card card-default">
    <div class="card-body px-5">

        <form role="form" action="{{ route('settings.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group">
                <h3>Main Logo</h3>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="main_logo">
                @isset($main_logo)
                <img src="/file_storage/{{ $main_logo->value }}" style="max-height: 200px;" class="img-fluid mt-2"
                    alt="Responsive image">
                @endisset
            </div>

            <div class="form-group">
                <h3>Invoice Address</h3>
                <textarea name="invoice_addr" id="" class="form-control mt-1 text-left"
                    rows="5">@isset($invoice_addr) {{ $invoice_addr->value }}@endisset</textarea>

            </div>


            <div class="from-group  text-center">
                <button type="submit" class="btn btn-success">Save Settings</button>
            </div>


        </form>
    </div>
</div>

@endsection

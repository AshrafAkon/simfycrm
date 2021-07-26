@extends('layouts.admin')

@section('head')
<title>Add a Custoemr</title>
@endsection

@section('main-content')
<h1 class="text-center mn-2">{{ isset($customer) ? 'Edit Customer' : 'Add a Customer' }}</h1>
<div class="card card-default">
    <div class="card-body px-5">

        <form role="form"
            action="{{ isset($customer) ? route( 'customers.update' , $customer->id) : route('customers.store')}}"
            method="POST">
            @csrf
            @if(isset($customer))
            @method('PATCH')
            @endif
            <!-- Product name -->
            <div class="form-group">
                <label>Customers Name <span>*</span></label>
                <input type="text" class="form-control" name="name"
                    value="{{isset($customer) ? $customer->name : old('name')}}" required="">
            </div>
            <div class="form-group">
                <label>Customer Phone<span>*</span></label>
                <input type="text" class="form-control" maxlength="11" minlength="11" name="phone"
                    value="{{isset($customer) ? $customer->phone : old('phone')}}" required="">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="address"
                    value="{{isset($customer) ? $customer->address : old('address')}}">
            </div>
            <div class="form-group">
                <label>Source</label>
                <input type="text" class="form-control" name="source"
                    value="{{isset($customer) ? $customer->source : old('source')}}">
            </div>

            <div class="from-group  text-center">
                <button type="submit"
                    class="btn btn-success">{{isset($customer) ? 'Update Customer' : 'Add Customer'}}</button>
            </div>
        </form>
    </div>
</div>

@endsection

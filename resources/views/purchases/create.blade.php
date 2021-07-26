@extends('layouts.admin')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
<title>Add a purchase</title>
@endsection

@section('main-content')

<div class="card card-default">
    <div class="card-body px-5">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-group">
                @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">
                    {{$error}}
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        <form role="form" action="{{isset($purchase) ? route('purchases.update', $purchase->id) :  route('purchases.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($purchase))
            @method('PUT')
            @endif

            <div class="form-group">
                <label>Select product <span>*</span></label>
                <select name="products_id" id="products_id" class="form-control">
                    @foreach($products as $product)
                    <option value="{{$product->id}}" {{isset($purchase) ? ($purchase->products->id== $product->id ? 'selected' : '') : ''}}>{{$product->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Buying Price <span>*</span></label>
                <input type="text" class="form-control" name="buying_price" value="{{isset($purchase) ? $purchase->buying_price : ''}}">
            </div>
            <div class="form-group">
                <label>Quantity<span>*</span></label>
                <input type="text" class="form-control" name="quantity" value="{{isset($purchase) ? $purchase->quantity : '' }}">
            </div>
            <div class="from-group  text-center">
                <button type="submit" class="btn btn-success">{{isset($purchase) ? 'Edit purchase' : 'Add purchase'}}</button>
            </div>
        </form>
    </div>
</div>

@endsection
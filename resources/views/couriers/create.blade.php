@extends('layouts.admin')

@section('head')
<title>Add a Courier</title>
@endsection

@section('main-content')
<h1 class="text-center mn-2">Add a Courier</h1>
<div class="card card-default">
    <div class="card-body px-5">
        <!-- @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-group">
                @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">
                    {{$error}}
                </li>
                @endforeach
            </ul>
        </div>
        @endif -->
        <form role="form" action="{{ isset($courier) ? route( 'couriers.update' , $courier->id) : route('couriers.store')}}" method="POST">
            @csrf
            @if(isset($courier))
            @method('PUT')
            @endif
            <!-- Product name -->
            <div class="form-group">
                <label>Courier Name <span>*</span></label>
                <input type="text" class="form-control" name="name" value="{{isset($courier) ? $courier->name : ''}}" required="">
            </div>
            <div class="form-group">
                <label>Courier Charge<span>*</span></label>
                <input type="text" class="form-control" name="charge" value="{{isset($courier) ? $courier->charge : ''}}" required="">
            </div>

            <div class="from-group  text-center">
                <button type="submit" class="btn btn-success">{{isset($courier) ? 'Update Courier' : 'Add Courier'}}</button>
            </div>
        </form>
    </div>
</div>

@endsection
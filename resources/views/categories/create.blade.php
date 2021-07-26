@extends('layouts.admin')

@section('head')
<title>Add a Category</title>
@endsection

@section('main-content')
<h1 class="text-center mn-2">Add a product</h1>
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
        <form role="form" action="{{ isset($category) ? route( 'categories.update' , $category->id) : route('categories.store')}}" method="POST">
            @csrf
            @if(isset($category))
            @method('PUT')
            @endif
            <!-- Product name -->
            <div class="form-group">
                <label>Category Name <span>*</span></label>
                <input type="text" class="form-control" name="name" value="{{isset($category) ? $category->name : ''}}" required="">
            </div>

            <div class="from-group  text-center">
                <button type="submit" class="btn btn-success">{{isset($category) ? 'Edit Category' : 'Add Category'}}</button>
            </div>
        </form>
    </div>
</div>

@endsection
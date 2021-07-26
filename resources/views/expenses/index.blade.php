@extends('layouts.admin')
@section('head')
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@endsection

@section('main-content')
{{$expenses}}
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header">All Expenses</h1>
        </div>

        <div class="col-lg-12">
            <!-- </div> -->

            <!-- <div class="row"> -->
            <div class="card shadow mb-4">
                <div class="card-body">

                    <!-- search bar and add new product -->
                    <div class="row text-center">

                        <div class=" col-lg float-left mb-2">
                            <!-- search bar -->
                            <input type="text" class="form-control " id="search" name="search" placeholder="Search name"></input>
                        </div>


                        <div class=" col  mb-2">
                            <a href="{{route('expenses.create')}}" class="btn btn-success float-right mb-2">Add New
                                expense</a>
                        </div>

                    </div>
                    <!-- search bar and add new product -->
                    @if($expenses->count())
                    <div class="table-responsive">
                        <!-- <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable"> -->
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">

                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <!-- <th>Image</th> -->
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($expenses as $key => $expense)

                                <tr>

                                    <td>{{ $key + 1}}</td>
                                    <!-- <td>
                                        @if(isset($product->image))
                                        <img src="{{  route('product_thumbnails', $product->image) }}" height="40px"
                                            alt="Product Thumbnail">
                                        @else
                                        <img src="img/svg/no_product.svg" height="40" width="40" alt="">
                                        @endif
                                    </td> -->
                                    <td>{{$expense->date}}</td>
                                    <td>{{$expense->amount}}</td>
                                    <td>
                                        <div class="row text-center">

                                            <div class="col">

                                                <form action="{{route('expenses.show', $expense->id) }}" method="GET">
                                                    @csrf
                                                    <button class=" btn btn-info" type="submit">View</button>

                                                </form>

                                            </div>
                                            <div class="col">
                                                <form action="{{route('expenses.destroy', $expense->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class=" btn btn-danger" type="submit">Delete</button>

                                                </form>


                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    @else
                    <hr class="sidebar-divider my-0">
                    <h4 class="text-center mt-3">No expense to show.</h4>
                    @endif
                </div>

            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
        <!-- </div> -->
    </div>

    @endsection
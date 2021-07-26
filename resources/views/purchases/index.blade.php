@extends('layouts.admin')
@section('head')
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@endsection

@section('main-content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header">{{$trashed ? 'Trashed purchases' : 'All purchases'}}</h1>

        </div>
        <div class="col-lg-12">
            <!-- </div> -->

            <!-- <div class="row"> -->
            <div class="card shadow mb-4">
                <div class="card-body">

                    <!-- search bar and add new purchase -->
                    <div class="row text-center">

                        <!-- <div class=" col-lg float-left mb-2">
                          
                        <input type="text" class="form-control " id="search" name="search" placeholder="Search name"></input>
                    </div> -->

                        <form class="col-sm-1" method="GET" action="{{ url()->current() }}" role="form">
                            <!-- <div class="form-group">
                            <label class="col" for="perPage">Example select: </label> -->
                            <select type="submit" class="form-control" id="perPage" name="perPage">
                                <option value="10" @if($selected==10) selected @endif>10</option>
                                <option value="25" @if($selected==25) selected @endif>25</option>
                                <option value="50" @if($selected==50) selected @endif>50</option>
                                <option value="100" @if($selected==100) selected @endif>100</option>
                            </select>
                            <!-- </div> -->
                        </form>
                        <div class=" col  mb-2">
                            @if(!($trashed))
                            <a href="{{route('purchases.create')}}" class="btn btn-success float-right mb-2">
                                Purchase a Product</a>
                            @endif
                        </div>

                    </div>
                    <!-- search bar and add new purchase -->
                    @if($purchases->count())
                    <div class="table-responsive">

                        <!-- <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable"> -->
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">

                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Buying Price</th>
                                    <th>Quantity</th>
                                    <td>Date</td>
                                    <!-- <th></th> -->
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($purchases as $key => $purchase)

                                <tr>
                                    <!-- <td>{{$purchase->id}}</td> -->
                                    <td>{{$purchases->firstItem() + $key }}</td>
                                    <td>{{$purchase->products->name}}</td>
                                    <td>{{$purchase->buying_price}}</td>
                                    <td>{{$purchase->quantity}}</td>
                                    <td>{{$purchase->created_at->format('d M y')}}</td>
                                    <!-- @if(!$purchase->trashed())
                                    <td><a class=" btn btn-info" href="{{route('purchases.show', $purchase->id) }}">View</a>
                                    </td>
                                    @else
                                    <td>
                                        <div class="row text-center">

                                            <div class="col">

                                                <form action="{{route('purchases.restore', $purchase->id) }}" method="GET">
                                                    @csrf
                                                    <button class=" btn btn-info" type="submit">Restore</button>

                                                </form>

                                            </div>
                                            <div class="col">

                                                <form action="{{route('purchases.destroy', $purchase->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class=" btn btn-danger" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    @endif -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$purchases->withQueryString()->links()}}

                    </div>

                    @else
                    <hr class="sidebar-divider my-0">
                    <h4 class="text-center mt-3">No purchases to show.</h4>
                    @endif
                </div>

            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
        <!-- </div> -->
    </div>

    @endsection

    @section('scripts')

    <script type="text/javascript">
        // saving the table. so when user will remove search string
        // it will load the previous saved table
        if (typeof old_table === 'undefined') {
            $old_table = $('tbody')[0].outerHTML;

        }
        $('#search').on('keyup', function(old_table) {

            $value = $(this).val();

            if ($value == '') {
                $('tbody').replaceWith($old_table);
            } else {
                $.ajax({
                    type: 'get',
                    url: "{{URL::to('search-purchases')}}",
                    data: {
                        'search': $value,
                        'perPage': console.log(document.getElementById('perPage').value),
                        'trashed': "{{$trashed}}"


                    },
                    success: function(data) {
                        $('tbody').html(data);
                    }
                });
            }
        })
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>

    <script>
        // submits get request when perpage value is changed
        document.getElementById('perPage').onchange = function() {
            window.location = "{{{url()->current()}}}?page=" + "{{$purchases->currentPage()}}" + "&perPage=" + this
                .value;
        };;
    </script>


    @endsection
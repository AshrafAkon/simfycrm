@extends('layouts.admin')
@section('head')
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@endsection

@section('main-content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header">{{$trashed ? 'Trashed Customers' : 'All Customers'}}</h1>
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
                            <input type="text" class="form-control " id="search" name="search"
                                placeholder="Search Phone"></input>
                        </div>

                        <form class="col-sm-1" method="GET" action="{{ url()->current() }}" role="form">

                            <select type="submit" class="form-control" id="perPage" name="perPage">
                                <option value="10" @if($selected==10) selected @endif>10</option>
                                <option value="25" @if($selected==25) selected @endif>25</option>
                                <option value="50" @if($selected==50) selected @endif>50</option>
                                <option value="100" @if($selected==100) selected @endif>100</option>
                            </select>

                        </form>
                        <div class=" col  mb-2">
                            @if(!$trashed)
                            <a href="{{route('customers.create')}}" class="btn btn-success float-right mb-2">Add new
                                Customer</a>
                            @endif
                        </div>

                    </div>
                    <!-- search bar and add new product -->
                    @if($customers->count())
                    <div class="table-responsive">

                        <!-- <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable"> -->

                        @include('customers.table', array('customers' => $customers))
                        {{$customers->withQueryString()->links()}}

                    </div>

                    @else
                    <hr class="sidebar-divider my-0">
                    <h4 class="text-center mt-3">No products to show.</h4>
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
            if ($value.length >= 3)
                console.log($value);
                if ($value == '') {
                    $('tbody').replaceWith($old_table);
                } else {
                    $.ajax({
                        type: 'get',
                        url: "{{URL::to('customer-search-phone-name')}}",
                        data: {
                            'search': $value,
                            'perPage': document.getElementById('perPage').value,
                            'trashed': "{{$trashed}}"


                        },
                        success: function(data) {
                            console.log(data)
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
            window.location = "{{{url()->current()}}}?page=" + "{{$customers->currentPage()}}" + "&perPage=" + this
                .value;
        };;
    </script>


    @endsection

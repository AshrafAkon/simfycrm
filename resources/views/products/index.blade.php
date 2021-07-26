@extends('layouts.admin')
@section('head')
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@endsection

@section('main-content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header">{{isset($trashed) ? 'Trashed Products' : 'All Products'}}</h1>

        </div>
        <div class="col-lg-12">
            <!-- </div> -->

            <!-- <div class="row"> -->
            <div class="card shadow mb-4">
                <div class="card-body">

                    <!-- search bar and add new product -->
                    <div class="row text-center">
                        <div class=" col mb-2">
                            <!-- search bar -->
                            <div class="row">
                                <input type="text" class="form-control col-lg" id="search" name="search"
                                    placeholder="Search Code"></input>

                                <form class="col-sm-3" method="GET" action="{{ url()->current() }}" role="form">
                                    <select type="submit" class="form-control" id="search_param" name="search_param">
                                        <option value="name">Name</option>
                                        <option value="product_code">Code</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <!-- <div class=" col-lg float-left mb-2">

                            <input type="text" class="form-control " id="search" name="search" placeholder="Search code"></input>
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
                            @if(!isset($trashed))
                            <a href="{{route('products.create')}}" class="btn btn-success float-right mb-2">Add New
                                Product</a>
                            @endif
                        </div>

                    </div>
                    <!-- search bar and add new product -->
                    @if($products->count())
                    <div class="table-responsive">

                        <!-- <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable"> -->
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                            style="width:100%">

                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Category</th>
                                    <th>Selling Price</th>
                                    @if(Auth::user()->hasPermissionTo('view-buying-price') == 1)
                                    <th>Buying Price</th>
                                    @endif
                                    <th>Quantity</th>
                                    <th></th>
                                    <!--<th>Description</th>-->
                                    <!--<th>Photo</th>-->
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($products as $key => $product)

                                <tr>
                                    <!-- <td>{{$product->id}}</td> -->
                                    <td>{{$products->firstItem() + $key }}</td>
                                    <td>
                                        @if(isset($product->image))
                                        <img src="{{  route('product_thumbnails', $product->image) }}" height="40px"
                                            alt="Product Thumbnail">
                                        @else
                                        <img src="img/svg/no_product.svg" height="40" width="40" alt="">
                                        @endif
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->product_code}}</td>
                                    <td>{{$product->Category->name}}</td>
                                    <td>{{$product->selling_price}}</td>
                                    @if(Auth::user()->hasPermissionTo('view-buying-price') == 1)
                                    <td>{{$product->buying_price}}</td>

                                    @endif
                                    <td>{{$product->quantity}}</td>
                                    @if(!$product->trashed())
                                    <td>
                                        <div class="row text-center">

                                            <div class="col">

                                                <a class=" btn btn-info"
                                                    href="{{route('products.show', $product->id) }}">View</a>

                                            </div>


                                            @if(Auth::user()->hasPermissionTo('delete') == 1)
                                            <div class="col">

                                                <form action="{{route('products.destroy', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class=" btn btn-danger" type="submit">Delete</button>

                                                </form>


                                            </div>


                                            @endif

                                        </div>
                                    </td>

                                    @else
                                    <td>
                                        <div class="row text-center">

                                            <div class="col">

                                                <form action="{{route('products.restore', $product->id) }}"
                                                    method="GET">
                                                    @csrf
                                                    <button class=" btn btn-info" type="submit">Restore</button>
                                                </form>
                                            </div>
                                            <div class="col">

                                                <form action="{{route('products.destroy', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class=" btn btn-danger" type="submit">Delete</button>

                                                </form>


                                            </div>

                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$products->withQueryString()->links()}}

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


            if ($value == '') {
                $('tbody').replaceWith($old_table);
            } else {
                $.ajax({
                    type: 'post',
                    url: "/search-products-with-code",
                    data: {
                        'search': $value,
                        'perPage': document.getElementById('perPage').value,
                        'search_param': $("#search_param").val(),
                        '_token': '{{csrf_token()}}'

                    },
                    success: function(data) {
                        console.log(data);

                        $('tbody').html(data);
                        //$('#data-table'). html(data);

                    }
                });
            }
        })
        $('#search_param').change(function() {
            console.log($('#search_param option:selected').html());
            $("#search").attr("placeholder", "Search " + $('#search_param option:selected').html());
        });
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
            window.location = "{{{url()->current()}}}?page=" + "{{$products->currentPage()}}" + "&perPage=" + this
                .value;
        };;
    </script>


    @endsection

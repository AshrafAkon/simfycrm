@extends('layouts.admin')
@section('main-content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header">View Details</h1>
        </div>
        <div class="col-lg-12">
            <!-- </div> -->

            <!-- <div class="row"> -->
            <div class="card shadow mb-4">
                <div class="row text-center">


                    <div class=" col m-3">
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-success float-right">Edit
                            Customer</a>
                    </div>

                </div>
                <div class="card-body">


                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" value="{{$customer->name}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" value="{{$customer->phone}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" value="{{$customer->address}}" disabled>
                        </div>
                    </div>

                </div>

            </div>
            <!-- search bar and add new product -->
            <div class="row text-center">

                <div class=" col-lg float-left mb-2">
                    <!-- search bar -->
                    <input type="text" class="form-control " id="search" name="search"
                        placeholder="Search Invoice Id"></input>
                </div>

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
                    <a href="{{route('invoices.create')}}" class="btn btn-success float-right mb-2">Add new Invoice</a>
                </div>
            </div>
            @include('invoices.table', $invoices)
            <!-- @if($invoices->count() > 0)
            <table class="table  table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Invoice Id</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $key => $invoice)
                    <tr>
                        <th scope="row">{{$invoices->firstItem() + $key }}</th>
                        <td>{{$invoice->id}}</td>
                        <td>{{$invoice->amount}}</td>
                        <td>{{$invoice->status}}</td>
                        <td>{{$invoice->created_at->format('d M y')}}</td>
                        <td>
                            <div class="row">
                                <div class="row">
                                    <div class="col-sm ml-3">
                                        <form action="#" method="GET">
                                            @csrf
                                            <button class=" btn btn-info" type="submit">Edit</button>
                                        </form>
                                    </div>
                                    <div class="col-sm">

                                        <button onclick="printPage('http://127.0.0.1:8000/img/svg/no_product.svg');" class=" btn btn-info" type="submit">Print</button>

                                    </div>
                                    <div class="col-sm">
                                        <form action="#" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class=" btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
            @else
            <h3 class="text-center">No invoice for this customer</h3>
            @endif
            {{$invoices->withQueryString()->links()}} -->
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    // saving the table. so when user will remove search string
    // it will load the previous saved table
    if (typeof old_table === 'undefined') {
        $old_table = $('tbody')[0].outerHTML;

    }
    $('#search').on('keyup', function (old_table) {

        $value = $(this).val();

        if ($value == '') {
            $('tbody').replaceWith($old_table);
        } else {
            $.ajax({
                type: 'get',
                url: "search-invoice-id-from-customer",
                data: {
                    'search': $value,
                    'perPage': document.getElementById('perPage').value

                },
                success: function (data) {
                    console.log(data);
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
    document.getElementById('perPage').onchange = function () {
        window.location = "{{{url()->current()}}}?page=" + "{{$invoices->currentPage()}}" + "&perPage=" + this
            .value;
    };;
</script>

@endsection
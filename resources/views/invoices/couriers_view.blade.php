@extends('layouts.admin')
@section('head')
<meta name="_token" content="{{ csrf_token() }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
@endsection

@section('main-content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="page-header">{{$trashed ? 'Trashed Invoices' : 'All Invoices'}}</h1>

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
                                placeholder="Invoice ID"></input>
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


                        </form>
                        <form class="col-md" method="GET" action="{{ url()->current() }}" role="form">
                            <!-- <div class="form-group">
                            <label class="col" for="perPage">Example select: </label> -->
                            <select type="submit" class="form-control" id="courier_select" name="courier_select">
                                @foreach($couriers as $courier)
                                <option value="{{$courier->id}}" {{$courierid == $courier->id ? "selected" : ""}}
                                    </option>{{$courier->name}}
                                </option>
                                @endforeach
                            </select>
                        </form>
                        <div class=" col  mb-2">
                            <a href="{{route('invoices.create')}}" class="btn btn-success float-right mb-2">create
                                Invoice</a>
                        </div>

                    </div>
                    <!-- search bar and add new product -->
                    @include('invoices.table', $invoices)
                </div>

            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
        <!-- </div> -->
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    function onStatusChangeIndex(event, id, priv_status) {


        $.ajax({
            type: 'post',
            url: "change-invoice-status",
            data: {
                'id': id,
                'invoicestatus_id': event.value,
                'status': event.options[event.selectedIndex].text,
                'privious_status': priv_status,
                '_token': '{{csrf_token()}}'

            },
            success: function (data) {
                console.log(data);

            }
        });
    }
</script>

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
                type: 'post',
                url: "/search-invoice-id",
                data: {
                    'search': $value,
                    'perPage': document.getElementById('perPage').value,
                    '_token': '{{csrf_token()}}'

                },
                success: function (data) {

                    $('tbody').html(data);
                }
            });
        }
    })
</script>
<script>
    $('#courier_select').on('change', function (old_table) {

        $value = $(this).val();
        let url = new URL(window.location.href);
        url.searchParams.set('courier_id', $value);
        window.location.href = url.href;
        // if (window.location.href.includes("?") && window.location.href.includes('courier_id') == false) {
        // // other arguments are present

        // window.location.href = window.location.href + "&courier_id=" + $value;
        // } else {
        // // no arguments present. so need the question mark
        // // for get request
        // window.location.href = "{{{url()->current()}}}?page=" + "{{$invoices->currentPage()}}" + "&courier_id=" + $value;

        // }
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
        let url = new URL(window.location.href);
        url.searchParams.set('perPage', this.value);
        window.location.href = url.href;
        // if (window.location.href.includes("?")) {
        //     window.location.href = window.location.href + "&perPage=" + this.value;

        // } else {
        //     window.location.href = "{{{url()->current()}}}?page=" + "{{$invoices->currentPage()}}" + "&perPage=" + this
        //         .value;
        // }
    }
</script>

@endsection
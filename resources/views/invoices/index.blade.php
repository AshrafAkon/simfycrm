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
            <div class="card shadow p-2">
                <div class="card-body" id="table-parent">

                    <!-- search bar and add new product -->
                    <div class="row text-center ml-1.5">

                        <div class=" col mb-2">
                            <!-- search bar -->
                            <div class="row">
                                <input type="text" class="form-control col-lg" id="search" name="search"
                                    placeholder="Invoice ID"></input>

                                <form class="col-sm-3" method="GET" action="{{ url()->current() }}" role="form">
                                    <select type="submit" class="form-control" id="search_param" name="search_param">
                                        <option value="name">Name</option>
                                        <option value="id">Id</option>
                                        <option value="phone">Phone</option>
                                    </select>
                                </form>
                            </div>
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
                        <div class="col" style="padding-right: 0;">
                            <a href="{{route('invoices.create')}}" class="btn btn-success float-right">create
                                Invoice</a>
                        </div>

                    </div>
                    <!-- search bar and add new product -->

                    @include('invoices.table', array('invoices' => $invoices,
                    'trashed' => $trashed))
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


        // axios.post(
        //     "/change-invoice-status", {
        //                 'id': id,
        //         'invoicestatus_id': event.value,
        //         'status': event.options[event.selectedIndex].text,
        //         'privious_status': priv_status,
        //         '_token': '{{csrf_token()}}'

        //     }
        // ).then(function(resp){
        //     console.log(resp);
        // }).catch(function(err){
        //     console.log(err);
        // })
        $.ajax({
            type: 'post',
            url: "/change-invoice-status",
            data: {
                'id': id,
                'invoicestatus_id': event.value,
                'status': event.options[event.selectedIndex].text,
                'privious_status': priv_status,
                '_token': '{{csrf_token()}}'

            },
            success: function(data) {
                console.log(data);
                toastr.info('Invoice status changed to: '+data);

            },
            error: function(err){
                console.log(err);
                toastr.error('Something went wrong.');
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
    $('#search').on('keyup', function(old_table) {

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
                    'search_param': $("#search_param").val(),
                    '_token': '{{csrf_token()}}'

                },
                success: function(data) {
                    console.log(data);
                    let table = document.getElementById('data-table');
                    if (table) {
                        document.getElementById('data-table').outerHTML = data;
                    }
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
        window.location = "{{{url()->current()}}}?page=" + "{{$invoices->currentPage()}}" + "&perPage=" + this
            .value;
    };;
</script>

@endsection

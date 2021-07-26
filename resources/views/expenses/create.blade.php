@extends('layouts.admin')

@section('head')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


@endsection

@section('main-content')
<div class="card">
    <div class="card-body">



        <div class="main-content" id="panel">
            <div id="main-body">
                <div class="container-fluid content-layout mt--6">
                    <div id="app">

                        <div class="card" id="add_button">
                            <expense save_url="{{route('expenses.store')}}"></expense>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')


<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script src="{{asset('js/app.js')}}"></script>
<script type="text/javascript">
    // not sure why its here but its needed
    $('.selectpicker').selectpicker();

    // saving the table. so when user will remove search string
    // it will load the previous saved table



    // initatiates ajax request for customer search
    let customers = [];
    $(document).ready(function() {
        $('#select-customer .bs-searchbox input').on('keyup', function() {

            $value = $(this).val();
            if ($value != '') {
                $.ajax({
                    type: 'get',
                    url: "{{route('invoice-create-name')}}",
                    data: {
                        'search': $value
                    },
                    success: function(data) {

                        // filtering already available data
                        let unique_data = data.data.filter(function(obj) {
                            for (i = 0; i < customers.length; i++) {

                                if (customers[i].id == obj.id) {
                                    return false;
                                }
                            }
                            return true;
                        });

                        // saving the unique customer list to already available customer list
                        customers = customers.concat(unique_data);
                        if (unique_data.length > 0) {
                            // appending unique data list to customer list
                            for (i = 0; i < unique_data.length; i++) {
                                $('#select-customer-list').append('<option id="' + unique_data[i].id + '">' + unique_data[i].name + " - " + unique_data[i].phone + '</option>');
                                $('.selectpicker').selectpicker('refresh');
                            }
                        }
                    }
                });
            }
        })

        $('#search-product .bs-searchbox input').on('keyup', function() {
            console.log('yo');
            $value = $(this).val();
            if ($value != '') {
                $.ajax({
                    type: 'get',
                    url: "{{route('products.list')}}",
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        //console.log(products);
                        let unique_data = data.data.filter(function(obj) {
                            //console.log('yo');
                            for (i = 0; i < products.length; i++) {
                                if (products[i].id == obj.id) {
                                    return false;
                                }
                            }
                            return true;
                            //return products.indexOf(obj) == -1;
                        });

                        //console.log(data.data);
                        //console.log("unique ", unique_data);
                        products = products.concat(unique_data);
                        if (unique_data.length > 0) {
                            for (i = 0; i < unique_data.length; i++) {

                                $('#select-product-list').append('<option id="' + unique_data[i].id + '">' + unique_data[i].name + '</option>');
                                $('.selectpicker').selectpicker('refresh');
                            }
                        }
                    }
                });
            }
        })

        $('#select-product-list').on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {
            console.log(e);
            console.log(isSelected);
            console.log(clickedIndex);
        });


    })
</script>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    });
</script>




@endsection
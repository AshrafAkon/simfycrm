<div id="data-table" class="row">
    @if($invoices->count())
    <div class="table-responsive">

        <!-- <table width="100%" class="table table-striped table-bordered table-hover" id="dataTable"> -->
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">

            <thead>
                <tr>
                    <th>SL</th>
                    <th>Invoice Id</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                    <!--<th>Description</th>-->
                    <!--<th>Photo</th>-->
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $key => $invoice)
                <tr>
                    <th scope="row">{{$invoices->firstItem() + $key }}</th>
                    <td>{{$invoice->id}}</td>
                    <td>{{$invoice->customer->name}}</td>
                    <td>{{$invoice->customer->phone}}</td>
                    <td>{{$invoice->amount}}</td>
                    <td>
                        <!-- <select class="form-control" onchange="onStatusChangeIndex(this, {{$invoice->id}})">
                        <option value="Invoiced" @if($invoice->status=="Invoiced") selected @endif>Invoiced</option>
                        <option value="Packing" @if($invoice->status=="Packing") selected @endif>Packing</option>
                        <option value="Shipped" @if($invoice->status=="Shipped") selected @endif>Shipped</option>
                        <option value="Delivered" @if($invoice->status=="Delivered") selected @endif>Delivered</option>
                        <option value="Returned" @if($invoice->status=="Returned") selected @endif>Returned</option>
                    </select> -->

                        <select class="form-control" @if($invoice->invoicestatus->status == "Delivered") disabled @endif
                            onchange="onStatusChangeIndex(this, {{$invoice->id}},
                            '{{$invoice->invoicestatus->status}}')">
                            @foreach($invoicestatuses as $status)
                            <option value="{{$status->id}}" @if($invoice->invoicestatus_id == $status->id) selected
                                @endif>{{$status->status}}</option>
                            @endforeach
                        </select>


                    </td>
                    <td>{{$invoice->created_at->format('d M y')}}</td>
                    <td>
                        <div class="row">
                            <div class="row">
                                @if(!$invoice->trashed())
                                <div class="col-sm ml-3">
                                    <form action="{{route('invoices.edit', $invoice->id)}}" target="_blank"
                                        method="GET">
                                        @csrf
                                        <button class=" btn btn-info" type="submit">Edit</button>
                                    </form>
                                </div>
                                @else
                                <div class="col-sm mx-1">
                                    <form action="{{route('invoices.restore', $invoice->id) }}" method="GET">
                                        @csrf
                                        <button class=" btn btn-primary" type="submit">Restore</button>
                                    </form>
                                </div>
                                @endif
                                <div class="col-sm">
                                    <a href="{{route('invoices.print', $invoice->id)}}" target="_blank"
                                        class=" btn btn-info" type="submit">Print</a>
                                </div>
                                @if(Auth::user()->hasPermissionTo('delete') == 1)
                                <div class="col-sm">
                                    <form action="{{route('invoices.destroy', $invoice->id)}}" target="_blank"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class=" btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        {{$invoices->withQueryString()->links()}}

    </div>


    @else
    <hr class="sidebar-divider my-0">
    <h4 class="text-center mt-3">No invoices to show.</h4>
    @endif
</div>

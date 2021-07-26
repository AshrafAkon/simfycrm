<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">

    <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th></th>

        </tr>
    </thead>
    <tbody>

        @foreach($customers as $key => $customer)

        <tr>
            <td>{{$customers->firstItem() + $key }}</td>
            <td>{{$customer->name}}</td>
            <td>{{$customer->phone}}</td>
            <td>{{$customer->address}}</td>

            @if(!$customer->trashed())

            <td>
                <div class="row">
                    <a class=" btn btn-info ml-2" href="{{route('customers.show', $customer->id) }}">View</a>
                    <a class=" btn btn-primary ml-2" href="{{route('customers.edit', $customer->id) }}">Edit</a>

                    @if(Auth::user()->hasPermissionTo('delete') == 1)
                    <div class="col">

                        <form action="{{route('customers.destroy', $customer->id) }}" method="POST">
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

                        <form action="{{route('customers.restore', $customer->id) }}" method="GET">
                            @csrf
                            <button class=" btn btn-info" type="submit">Restore</button>

                        </form>

                    </div>
                    @if(Auth::user()->hasPermissionTo('delete') == 1)
                    <div class="col">

                        <form action="{{route('customers.destroy', $customer->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class=" btn btn-danger" type="submit">Delete</button>

                        </form>

                    </div>
                    @endif
                </div>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
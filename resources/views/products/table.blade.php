@foreach($products as $key => $product)

<tr>
    <!-- <td>{{$product->id}}</td> -->
    <td>{{$products->firstItem() + $key }}</td>
    <td>
        @if(isset($product->image))
        <img src="{{  route('product_thumbnails', $product->image) }}" height="40px" alt="Product Thumbnail">
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
    <td><a class=" btn btn-info" href="{{route('products.show', $product->id) }}">View</a>
    </td>
    @else
    <td>
        <form action="{{route('products.restore', $product->id) }}" method="GET">
            @csrf
            <button class=" btn btn-info" type="submit">Restore</button>

        </form>
    </td>
    <td>
        <form action="{{route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class=" btn btn-danger" type="submit">Delete</button>

        </form>

    </td>
    @endif
</tr>
@endforeach

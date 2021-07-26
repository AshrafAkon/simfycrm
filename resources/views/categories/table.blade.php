@foreach($categories as $key => $category)

<tr>

    <td>{{$categories->firstItem() + $key }}</td>
    <!-- <td>
                                        @if(isset($product->image))
                                        <img src="{{  route('product_thumbnails', $product->image) }}" height="40px"
                                            alt="Product Thumbnail">
                                        @else
                                        <img src="img/svg/no_product.svg" height="40" width="40" alt="">
                                        @endif
                                    </td> -->
    <td>{{$category->name}}</td>
    <td>
        <div class="row text-center">


            <div class="col">

                <form action="{{route('categories.edit', $category->id) }}" method="GET">
                    @csrf
                    <button class=" btn btn-info" type="submit">Edit</button>

                </form>

            </div>
            @if(Auth::user()->hasPermissionTo('delete') == 1)
            <div class="col">
                <form action="{{route('categories.destroy', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class=" btn btn-danger" type="submit">Delete</button>

                </form>
            </div>
            @endif
        </div>
    </td>

</tr>
@endforeach

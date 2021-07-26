@extends('products.input_layout')

@section('input-data')
@if(Auth::user()->hasPermissionTo('view-buying-price') == 1)


<div class="row">
    <div class=" col  mb-2">
        <a href="{{route('products.edit', $product->id)}}" class="btn btn-success float-right mb-2">Edit Product</a>
    </div>
</div>
@endif

<div class="form-group">
    <label>Product Name <span>*</span></label>
    <input type="text" class="form-control" name="name" value="{{$product->name}}" disabled>
</div>
<!-- Product Category -->
<div class="form-group">
    <!-- <div>{{isset($categories) ? $categories : 'one'}}</div> -->
    <label>Category Name <span>*</span></label>
    <select class=" form-control" id="category_id" name="category_id" disabled>
        <!-- <option value="">==Select==</option> -->
        <option value="{{$product->id}}">{{$product->category->name}}</option>
    </select>
</div>
<!-- product sub category -->
@if(isset($product->sub_category))
<div class="form-group">
    <label>Sub Category Name</label>
    <input type="text" class="form-control prod_sku" name="sub_category" value="{{$product->sub_category}}" disabled>
</div>
@endif
<p id="textboxError"></p>
<!-- Product Code -->
<div class="form-group">
    <label>Product Code(SKU) <span>*</span></label>
    <input type="text" class="form-control prod_sku" name="product_code" value="{{$product->product_code}}" disabled>
</div>
<!-- description -->

@if(isset($product->description) && $product->description != '' )
<div class="form-group">
    <label>Description</label>
    <input id="x" type="hidden" name="description" value="{{$product->description}}">
    <trix-editor input="x" style="height: 10em;" aria-disabled="description" contentEditable=false>
    </trix-editor>
</div>
@endif
<!-- buying price -->
<!-- add proper user authtentican only admin -->
@if(Auth::user()->hasPermissionTo('view-buying-price') == 1)
<div class="form-group">
    <label>Buying Price <span>*</span></label>
    <input type="text" class="form-control" name="buying_price" value="{{$product->buying_price}}" disabled>
</div>
@endif
<!-- selling price -->

<div class="form-group">
    <label>Selling Price <span>*</span></label>
    <input type="text" class="form-control" name="selling_price" value="{{$product->selling_price}}" disabled>
</div>
<!-- size -->
@if(isset($product->size))
<div class="form-group">
    <label>Size</label>
    <input type="text" class="form-control" name="size" value="{{$product->size}}" disabled>
</div>
@endif
<!-- color -->
@if(isset($product->color))
<div class="form-group">
    <label>Color</label>
    <input type="text" class="form-control" name="color" value="{{$product->color}}" disabled>
</div>
@endif
<!-- product image -->
@if(isset($product->image))
<div class="form-group">
    <img src="{{route('product_images', $product->image)}}" name="image" id="image" disabled>
</div>
@endif
@if(Auth::user()->hasPermissionTo('delete') == 1)
<!-- Button trigger modal -->
<div class="from-group  text-center mt-2">
    <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#exampleModal">Delete
        Product</button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Trash Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you want to trash "{{$product->name}}" ?
            </div>
            <div class="modal-footer">
                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Trash</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@extends('products.input_layout')
@section('top-title')
Add a product
@endsection

@section('input-data')

<form role="form" action="{{isset($product) ? route('products.update', $product->id) :  route('products.store')}}"
    method="post" enctype="multipart/form-data">
    @csrf
    @if(isset($product))
    @method('PUT')
    @endif
    <!-- Product name -->
    <div class="form-group">
        <label>Product Name <span>*</span></label>
        <input type="text" class="form-control" name="name" value="{{isset($product) ? $product->name : ''}}"
            required="">
    </div>
    <!-- Product Category -->
    <div class="form-group">
        <!-- <div>{{isset($categories) ? $categories : 'one'}}</div> -->
        <label>Category Name <span>*</span></label>
        <select class=" form-control" id="category_id" name="category_id" required="">
            <!-- <option value="">==Select==</option> -->
            @foreach($categories as $category)
            <option value="{{$category->id}}" {{// if product is selected then checking if category id matches the product category_id
                    isset($product) ? ($product->category_id == $category->id ? 'selected' : '') : ''}}>
                {{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <!-- product sub category -->
    <div class="form-group">
        <label>Sub Category Name</label>
        <input type="text" class="form-control prod_sku" name="sub_category"
            value="{{isset($product) ? $product->sub_category : '' }}">
    </div>
    <p id="textboxError"></p>
    <!-- Product Code -->
    <div class="form-group">
        <label>Product Code(SKU) <span>*</span></label>
        <input type="text" class="form-control prod_sku" name="product_code"
            value="{{isset($product) ? $product->product_code : '' }}" required="">
    </div>
    <!-- description -->
    <div class="form-group">
        <label>Description</label>
        <input id="x" type="hidden" name="description" value="{{isset($product) ? $product->description : ''}}">
        <trix-editor input="x" style="height: 10em;"></trix-editor>
    </div>
    <!-- buying price -->
    <div class="form-group">
        <label>Buying Price <span>*</span></label>
        <input type="text" class="form-control" name="buying_price"
            value="{{isset($product) ? $product->buying_price : ''}}">
    </div>
    <!-- selling price -->
    <div class="form-group">
        <label>Selling Price <span>*</span></label>
        <input type="text" class="form-control" name="selling_price"
            value="{{isset($product) ? $product->selling_price : ''}}">
    </div>
    <!-- quantity -->
    <div class="form-group">
        <label>Quantity<span>*</span></label>
        <input type="text" class="form-control" name="quantity" value="{{isset($product) ? $product->quantity : '' }}">
    </div>
    <!-- size -->
    <div class="form-group">
        <label>Size</label>
        <input type="text" class="form-control" name="size" value="{{isset($product) ? $product->size : '' }}">
    </div>
    <!-- color -->
    <div class=" form-group">
        <label>Color</label>
        <input type="text" class="form-control" name="color" value="{{isset($product) ? $product->color : ''}}">
    </div>
    <!-- product image -->
    @if(isset($product->image))
    <div class="form-group">
        <img src="{{route('product_images', $product->image)}}" name="image" id="image" disabled>
    </div>
    @endif
    <div class="form-group">
        <label>{{isset($product) ? 'Update Image' : 'Add Image'}}</label>
        <input type="file" class="form-control" name="image" id="image">
    </div>
    <div class="from-group  text-center">
        <button type="submit" class="btn btn-success">{{isset($product) ? 'Update Product' : 'Add Product'}}</button>
    </div>
</form>
@endsection

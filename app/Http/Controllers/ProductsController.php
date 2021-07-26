<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CreateProductRequest;
use App\Products;
use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if (isset($request['perPage'])) {
        //     dd($request);
        // }
        $perPage = request('perPage', 25);
        return view('products.index')->with('products', Product::orderBy('id', "DESC")->paginate($perPage))
            ->withselected($perPage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('products.create')->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {

        //$img   = Image::make($request->image)->resize(320, 240)->save(storage_path('thumbs\\' . bin2hex(random_bytes(32)) . '.jpg'), 60, 'jpg');
        $image = null;
        $thumbnail = null;
        if ($request->hasFile('image')) {
            // generating random name for image name
            $image = bin2hex(random_bytes(32)) . '.' . $request->file('image')->getClientOriginalExtension();

            // resizing the uploaded image to fit on product view page
            // respecting aspect ratio
            $img = Image::make($request->file('image')->getRealPath())
                ->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $img->stream(); // <-- Key point
            Storage::disk('local')->put('product_images/' . $image, $img);

            // resizing the main image to fit on the thumbnail and saving it
            $img = Image::make($request->file('image')->getRealPath())->resize(40, 40);
            $img->stream(); // <-- Key point
            Storage::disk('local')->put('product_thumbnails/' . $image, $img);
        }

        if ($request->exists('color') && $request->color != null) {
            if (strlen($request->color) != 0) {
                $name = $request->name . " - " . $request->color;
            }
        } else {
            $name = $request->name;
        }
        $product_id =  Product::create([
            'name' => $name,
            'category_id' => $request->category_id,
            'sub_category' => $request->sub_category,
            'product_code' => $request->product_code,
            'description' => $request->description,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'quantity' => $request->quantity,
            'size' => $request->size,
            'color' => $request->color,
            'image' => $image,
        ])->id;

        Purchase::create([
            "products_id" => $product_id,
            "buying_price" => $request->buying_price,
            "quantity" => $request->quantity
        ]);
        //dd($thumbnail);
        session()->flash('success', 'Product added successfully.');
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        // when editing a product and categories array should be provided
        return view('products.create')->withproduct($product)
            ->withcategories(Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProductRequest $request, Products $product)
    {
        //dd($request);
        //$img   = Image::make($request->image)->resize(320, 240)->save(storage_path('thumbs\\' . bin2hex(random_bytes(32)) . '.jpg'), 60, 'jpg');
        $image = null;
        $thumbnail = null;

        $data = $request->only(
            'name',
            'category_id',
            'sub_category',
            'product_code',
            'description',
            'buying_price',
            'selling_price',
            'quantity',
            'size',
            'color'
        );

        if ($request->exists('color') && $request->color != null) {
            if (strlen($request->color) != 0) {
                $name = $request->name . " - " . $request->color;
            }
        } else {
            $name = $request->name;
        }

        if ($request->hasFile('image')) {
            // generating random name for image name
            $image = bin2hex(random_bytes(32)) . '.' . $request->file('image')->getClientOriginalExtension();

            // resizing the uploaded image to fit on product view page
            // respecting aspect ratio
            $img = Image::make($request->file('image')->getRealPath())
                ->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $img->stream(); // <-- Key point
            Storage::disk('local')->put('product_images/' . $image, $img);

            // resizing the main image to fit on the thumbnail and saving it
            $img = Image::make($request->file('image')->getRealPath())->resize(40, 40);
            $img->stream(); // <-- Key point
            Storage::disk('local')->put('product_thumbnails/' . $image, $img);

            // deleting the previous image
            $product->deleteImage();

            // adding the new image name
            $data['image'] = $image;
        }

        $product->update($data);
        session()->flash('success', 'Product updated successfully.');
        return redirect(route('products.show', $product->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::withTrashed()->where('id', $id)->firstOrFail();
        if ($product->trashed()) {
            # deleting permanently
            $product->forceDelete();
            session()->flash('success', 'Post deleted successfuly');
            return redirect(route('products.trashed'));
        } else {
            // if not trashed befored then trashing
            $product->delete();
            session()->flash('success', 'Post has been trashed successfuly');
            return redirect(route('products.index'));
        }
    }
    public function trashed(Request $request)
    {
        //dd(Product::withTrashed()->get());

        $perPage = request('perPage', 25);
        //dd(Product::onlyTrashed()->paginate($perPage));
        return view('products.index')->with("products", Product::onlyTrashed()->paginate($perPage))
            ->withtrashed(true)
            ->withselected($perPage);
    }

    public function restore($id)
    {
        // restored a product
        Product::withTrashed()->find($id)->restore();
        session()->flash("success", "Post restored successfully");
        return redirect(route('products.trashed'));
    }

    function list(Request $request)
    {

        // change name
        if ($request->ajax()) {
            $customers = \App\Product::where('quantity', ">", 0)->get();
            if ($customers) {
                return Response($customers);
            }
        }
    }
    public function listallproducts()
    {
        return \App\Product::all();
    }
    public function search_products_with_code(Request $request)
    {
        if ($request->ajax()) {

            if ($request->trashed) {
                $products = \App\Product::where(request('search_param'), 'LIKE', '%' . $request->search . "%")->onlyTrashed()->paginate(request('perPage', 25));
            } else {
                $products = \App\Product::where(request('search_param'), 'LIKE', '%' . $request->search . "%")->paginate(request('perPage', 25));
            }

            if ($products) {
                return Response(view('products.table')->withproducts($products));
            }
        }
    }
}

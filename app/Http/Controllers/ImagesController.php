<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller {
	public function product_image($image) {
		// gets the image from storage then sends it as response
		return response()->make(Storage::disk('local')->get('product_images/' . $image), 200, ['content-type' => 'image/jpg']);
	}
	public function product_thumbnail($image) {
		// gets the image from storage then sends it as response
		return response()->make(Storage::disk('local')->get('product_thumbnails/' . $image), 200, ['content-type' => 'image/jpg']);
	}

}
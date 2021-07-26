<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->integer('category_id');
			$table->string('sub_category')->nullable();
			$table->string('name');
			$table->string('product_code');
			$table->text('description')->nullable();
			$table->string('size')->nullable();
			$table->string('color')->nullable();
			$table->integer('quantity')->default(0);
			$table->integer('buying_price');
			$table->integer('selling_price');
			$table->string('image')->nullable();
			$table->string('thumbnail')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('products');
	}
}
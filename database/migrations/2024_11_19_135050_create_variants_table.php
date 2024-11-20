<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->Integer('price');
            $table->string('sku'); // Đổi `BIGINT` sang `string` vì SKU thường là chuỗi.
            $table->unsignedBigInteger('product_id');
            $table->Integer('stock');
            $table->string('image'); // Đổi `BIGINT` sang `string` để lưu URL hoặc đường dẫn ảnh.
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variants');
    }
}

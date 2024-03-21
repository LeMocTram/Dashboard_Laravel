<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            // Khai báo cột id là khóa chính và tự động tăng
            $table->id();

            // Các cột khác
            $table->string('name');
            $table->longText('image');
            $table->string('price');
            $table->unsignedBigInteger('category_id');
            $table->timestamps(); // Thêm các trường timestamps (created_at và updated_at)
            $table->boolean('deleted')->default(0);

            // Tạo foreign key cho category_id tham chiếu tới id trong bảng categories
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

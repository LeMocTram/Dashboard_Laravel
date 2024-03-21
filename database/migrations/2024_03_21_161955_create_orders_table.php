<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('phone', 20);
            $table->string('email');
            $table->string('address');
            $table->string('total');
            $table->timestamps(); // Thêm các trường timestamps (created_at và updated_at)
            $table->string('fullname');
            $table->text('note')->nullable();
            $table->string('method');

            // Tạo foreign key cho customer_id tham chiếu tới id trong bảng customers
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

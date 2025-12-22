<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');

            $table->decimal('total', 11, 2)->nullable();
            $table->string('method')->nullable();
            $table->string('currency_code')->nullable();
            $table->string('order_number')->nullable();
            $table->decimal('shipping_charge', 11, 2)->nullable();
            $table->string('payment_status')->nullable();
            $table->string('order_status')->default('pending');
            $table->string('txnid')->nullable();
            $table->string('charge_id')->nullable();
            $table->string('receipt', 100)->nullable();
            $table->string('invoice_number', 255)->nullable();

            $table->string('billing_country')->nullable();
            $table->string('billing_name')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('billing_number')->nullable();
            $table->string('billing_zip')->nullable();
    

            $table->string('shipping_country')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_number')->nullable();
            $table->string('shipping_zip')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_orders');
    }
}

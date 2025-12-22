<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillpaidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billpaids', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('package_id')->nullable();
            $table->integer('status')->nullable();
            $table->double('package_cost')->nullable();
            $table->string('method')->nullable();
            $table->string('currency_sign')->nullable();
            $table->string('currency_code')->nullable();
            $table->string('currency_value')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('attendance_id')->nullable();
            $table->string('txn_id')->nullable();
            $table->string('yearmonth')->nullable();
            $table->string('fulldate')->nullable();
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
        Schema::dropIfExists('billpaids');
    }
}

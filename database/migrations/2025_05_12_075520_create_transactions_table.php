<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->integer('table_number');
            $table->text('optional_message')->nullable();
            $table->enum('payment_method', ['Cash', 'Transfer']);
            $table->text('cart_items'); // Menyimpan data cart dalam bentuk JSON
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

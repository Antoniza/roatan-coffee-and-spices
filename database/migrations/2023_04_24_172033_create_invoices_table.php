<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('id_client')->unsigned();
            $table->string('invoice_number');
            $table->json('shopping_details');
            $table->timestamp('shopping_date');
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_invoice_setting')->unsigned();
            $table->integer('elements');
            $table->string('pay_method');
            $table->string('pay_way');
            $table->double('sub_total');
            $table->double('sub_e');
            $table->double('sub_isv');
            $table->double('isv');
            $table->double('total');
            $table->string('words');
            $table->foreign('id_client')->references('id')->on('clients');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_invoice_setting')->references('id')->on('invoice_settings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

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
        Schema::create('invoice_settings', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('cai');
            $table->string('rtn');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('start_range');
            $table->string('end_range');
            $table->string('logo')->nullable();
            $table->bigInteger('update_by')->unsigned();
            $table->timestamps();
            $table->foreign('update_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_settings');
    }
};

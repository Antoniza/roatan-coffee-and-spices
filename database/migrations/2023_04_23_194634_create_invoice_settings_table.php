<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->integer('start_range');
            $table->integer('end_range');
            $table->string('logo')->nullable();
            $table->string('invoices_set');
            $table->integer('invoices');
            $table->double('dolar_change')->default(24.00);
            $table->json('invoice_header');
            $table->bigInteger('update_by')->unsigned();
            $table->timestamps();
            $table->foreign('update_by')->references('id')->on('users');
        });

        DB::statement('ALTER TABLE invoice_settings CHANGE invoices invoices INT(8) UNSIGNED ZEROFILL NOT NULL');
        DB::statement('ALTER TABLE invoice_settings CHANGE start_range start_range INT(8) UNSIGNED ZEROFILL NOT NULL');
        DB::statement('ALTER TABLE invoice_settings CHANGE end_range end_range INT(8) UNSIGNED ZEROFILL NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_settings');
    }
};

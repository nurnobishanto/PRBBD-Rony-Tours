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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->integer('operator');
            $table->string('bank_name');
            $table->string('account_name');
            $table->string('account_no');
            $table->string('branch_name')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('routing_no')->nullable();
            $table->string('charge_info')->nullable();
            $table->double('charge')->nullable();
            $table->integer('operator_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};

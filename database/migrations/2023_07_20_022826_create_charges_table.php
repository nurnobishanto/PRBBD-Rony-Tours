<?php

use App\Models\Order;
use App\Models\User;
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
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained((new User())->getTable());
            $table->string('subject')->nullable();
            $table->string('paid_by')->nullable();
            $table->double('amount');
            $table->string('trxid')->nullable();
            $table->string('status')->default('pending');
            $table->string('note')->nullable();
            $table->string('currency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charges');
    }
};

<?php

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained((new User())->getTable());
            $table->string('trxid')->unique();
            $table->string('trip_type')->nullable();
            $table->string('last_ticket_date')->nullable();

            $table->boolean('is_refundable')->nullable();
            $table->string('booking_id')->nullable();
            $table->string('booking_status')->nullable();

            $table->string('search_id')->nullable();
            $table->string('result_id')->nullable();

            $table->timestamp('booking_time')->nullable();
            $table->timestamp('booking_expired')->nullable();

            $table->double('total_amount')->nullable();
            $table->double('gross_amount')->nullable();
            $table->double('discount_amount')->nullable();
            $table->double('total_ws_amount')->nullable();
            $table->double('net_pay_amount')->nullable();

            $table->double('profit_amount')->nullable();
            $table->double('paid_amount')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('ticket_number')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

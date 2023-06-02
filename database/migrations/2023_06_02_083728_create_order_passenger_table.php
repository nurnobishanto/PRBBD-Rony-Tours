<?php

use App\Models\Order;
use App\Models\Passenger;
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
        Schema::create('order_passenger', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained((new Order())->getTable());
            $table->foreignId('passenger_id')->constrained((new Passenger())->getTable());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_passenger');
    }
};

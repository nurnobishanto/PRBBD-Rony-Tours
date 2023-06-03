<?php

use App\Models\Order;
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
        Schema::create('travels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained((new Order())->getTable());
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('carrier')->nullable();
            $table->string('distance')->nullable();
            $table->string('duration')->nullable();
            $table->string('cabin_class')->nullable();
            $table->string('arrival_time')->nullable();
            $table->string('departure_time')->nullable();
            $table->string('return_date')->nullable();
            $table->string('airline_name')->nullable();
            $table->string('airline_code')->nullable();
            $table->string('trip_group')->nullable();
            $table->string('trip_indicator')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel');
    }
};

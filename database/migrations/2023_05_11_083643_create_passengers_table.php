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
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained((new User())->getTable());
            $table->string('pax_index')->nullable();
            $table->string('ticket')->nullable();
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('pax_type');
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('gender');
            $table->date('dob')->nullable();
            $table->string('country')->nullable();
            $table->string('passport_no')->nullable();
            $table->date('passport_expire_date')->nullable();
            $table->string('nationality')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};

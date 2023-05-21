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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('pax_type');
            $table->string('password');
            $table->string('pass_text')->nullable();
            $table->string('country')->nullable();
            $table->string('country_code')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('image')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('trade_licence')->nullable();
            $table->string('passport')->nullable();
            $table->string('passport_nationality')->nullable();
            $table->string('nationality')->nullable();
            $table->string('passport_no')->nullable();
            $table->date('passport_exp')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('post_code')->nullable();
            $table->string('city')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('ffairline')->nullable();
            $table->string('ffnumber')->nullable();
            $table->double('balance')->default(0.00);
            $table->date('dob')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('user_type')->default(1);
            $table->boolean('agent_edit_permission')->default(true);
            $table->boolean('is_active')->default(true);
            $table->boolean('islead_passenger')->nullable(true);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

<?php

use App\Models\Support;
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
        Schema::create('msgs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('support_id')->constrained((new Support())->getTable());
            $table->string('body');
            $table->integer('sender')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('msgs');
    }
};

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
        Schema::create('variations_pro_details', function (Blueprint $table) {
            $table->foreignId('variation_id')->constrained()->cascadeOnDelete();
            $table->string('attr_name');
            $table->string('attr_val');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variations_pro_details');
    }
};

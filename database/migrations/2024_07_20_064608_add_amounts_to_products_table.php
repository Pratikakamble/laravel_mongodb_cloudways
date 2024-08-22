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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['amount','discount']);
            $table->string('mrp_amount')->nullable();
            $table->string('selling_amount')->nullable();
            $table->string('discount_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('amount');
            $table->string('discount');
            $table->dropColumn(['mrp_amount','selling_amount','discount_amount']);
        });
    }
};

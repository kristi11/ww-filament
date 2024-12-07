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
        Schema::table('product_variants', function (Blueprint $table) {
            $table->string('screenResolution')->nullable();
            $table->string('batteryCapacity')->nullable();
            $table->string('operatingSystem')->nullable();
            $table->string('connectivityOptions')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('cameraSpecifications')->nullable();
            $table->string('modelNumber')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropColumn('screenResolution');
            $table->dropColumn('batteryCapacity');
            $table->dropColumn('operatingSystem');
            $table->dropColumn('connectivityOptions');
            $table->dropColumn('dimensions');
            $table->dropColumn('cameraSpecifications');
            $table->dropColumn('modelNumber');
        });
    }
};

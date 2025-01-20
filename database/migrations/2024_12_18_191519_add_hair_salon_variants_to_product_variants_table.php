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
            $table->string('haircut_type')->nullable();
            $table->string('styling_preferences')->nullable();
            $table->string('coloring_options')->nullable();
            $table->string('service_levels')->nullable();
            $table->string('add_on_services')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropColumn('haircut_type');
            $table->dropColumn('styling_preferences');
            $table->dropColumn('coloring_options');
            $table->dropColumn('service_levels');
            $table->dropColumn('add_on_services');
        });
    }
};

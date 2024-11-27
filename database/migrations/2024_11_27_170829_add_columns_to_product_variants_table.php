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
            $table->string('age')->nullable();
            $table->string('pattern')->nullable();
            $table->string('weight')->nullable();
            $table->string('length')->nullable();
            $table->string('finish')->nullable();
            $table->string('gender')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropColumn('age');
            $table->dropColumn('pattern');
            $table->dropColumn('weight');
            $table->dropColumn('length');
            $table->dropColumn('finish');
            $table->dropColumn('gender');
        });
    }
};

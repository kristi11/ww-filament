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
            $table->string('material')->nullable();
            $table->string('dstorage')->nullable();
            $table->string('enginevolume')->nullable();
            $table->string('style')->nullable();
            $table->string('performance')->nullable();
            $table->string('specs')->nullable();
            $table->string('flavor')->nullable();
            $table->string('brand')->nullable();
            $table->string('processortype')->nullable();;
            $table->string('corecount')->nullable();;
            $table->string('graphiccardtype')->nullable();
            $table->string('memorysize')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropColumn('material');
            $table->dropColumn('enginevolume');
            $table->dropColumn('style');
            $table->dropColumn('performance');
            $table->dropColumn('specs');
            $table->dropColumn('flavor');
            $table->dropColumn('brand');
            $table->dropColumn('processortype');
            $table->dropColumn('corecount');
            $table->dropColumn('graphiccardtype');
            $table->dropColumn('memorysize');
        });
    }
};

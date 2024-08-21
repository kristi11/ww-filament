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
        Schema::table('heroes', function (Blueprint $table) {
            $table->string('gradientType')->default('linear-gradient');
            $table->string('gradientDegree')->change();
            $table->string('gradientDegreeStart')->change();
            $table->string('gradientDegreeEnd')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->dropColumn('gradientType');
            $table->integer('gradientDegree')->change();
            $table->integer('gradientDegreeStart')->change();
            $table->integer('gradientDegreeEnd')->change();
        });
    }
};

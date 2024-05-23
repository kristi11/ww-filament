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
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('mainQuote');
            $table->string('secondaryQuote')->nullable();
            $table->string('thirdQuote')->nullable();
            $table->integer('gradientDegree');
            $table->integer('gradientDegreeStart');
            $table->integer('gradientDegreeEnd');
            $table->string('gradientDegreeFirstColor');
            $table->string('gradientDegreeSecondColor');
            $table->text('image')->nullable();
            $table->boolean('waves')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};

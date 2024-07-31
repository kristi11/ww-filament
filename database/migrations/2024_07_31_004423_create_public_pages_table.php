<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('public_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->boolean('hero')->default(true);
            $table->boolean('credentials')->default(true);
            $table->boolean('services')->default(true);
            $table->boolean('hours')->default(true);
            $table->boolean('gallery')->default(true);
            $table->boolean('email')->default(true);
            $table->boolean('footer')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('public_pages');
    }
};

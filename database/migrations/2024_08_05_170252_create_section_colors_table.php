<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('section_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('loginBackgroundColor')->nullable();
            $table->string('servicesBackgroundColor')->nullable();
            $table->string('hoursBackgroundColor')->nullable();
            $table->string('galleryBackgroundColor')->nullable();
            $table->string('ctaBackgroundColor')->nullable();
            $table->string('footerBackgroundColor')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_colors');
    }
};

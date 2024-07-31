<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('public_pages', function (Blueprint $table) {
            $table->id();
            $table->boolean('hero');
            $table->boolean('credentials');
            $table->boolean('services');
            $table->boolean('hours');
            $table->boolean('gallery');
            $table->boolean('email');
            $table->boolean('footer');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('public_pages');
    }
};

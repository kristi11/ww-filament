<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flexibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->boolean('always_open')->default(false);
            $table->boolean('flexible_pricing')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flexibilities');
    }
};

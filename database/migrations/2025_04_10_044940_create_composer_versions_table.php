<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('system-versions.database.table_name', 'composer_versions'), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('current_version');
            $table->string('latest_version');
            $table->string('status');
            $table->text('description')->nullable();
            $table->boolean('direct_dependency');
            $table->boolean('abandoned');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('system-versions.database.table_name', 'composer_versions'));
    }
};

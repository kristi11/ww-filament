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
        Schema::table('c_r_u_d_settings', function (Blueprint $table) {
            $table->boolean('can_create_content')->default(true);
            $table->boolean('can_delete_content')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('c_r_u_d_settings', function (Blueprint $table) {
            $table->dropColumn('can_create_content');
            $table->dropColumn('can_delete_content');
        });
    }
};

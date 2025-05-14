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
        // Only add the read column if it doesn't already exist
        if (!Schema::hasColumn('leads', 'read')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->boolean('read')->default(false)->after('message');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only drop the column if it exists
        if (Schema::hasColumn('leads', 'read')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->dropColumn('read');
            });
        }
    }
};

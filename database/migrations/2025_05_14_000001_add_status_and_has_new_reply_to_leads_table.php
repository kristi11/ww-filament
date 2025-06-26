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
        Schema::table('leads', function (Blueprint $table) {
            if (! Schema::hasColumn('leads', 'status')) {
                $table->string('status')->default('new')->after('read');
            }

            if (! Schema::hasColumn('leads', 'has_new_reply')) {
                $table->boolean('has_new_reply')->default(false)->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            if (Schema::hasColumn('leads', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('leads', 'has_new_reply')) {
                $table->dropColumn('has_new_reply');
            }
        });
    }
};

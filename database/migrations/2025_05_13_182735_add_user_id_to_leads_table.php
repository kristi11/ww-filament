<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if user_id column exists before adding it
        if (!Schema::hasColumn('leads', 'user_id')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            });
        }

        // Get the first admin user to associate with existing leads
        $adminId = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', '=', 'super_admin')
            ->where('model_has_roles.model_type', '=', 'App\\Models\\User')
            ->value('users.id');

        // If no admin user found, use the first user
        if (!$adminId) {
            $adminId = DB::table('users')->value('id');
        }

        // Update existing leads to set the user_id
        if ($adminId) {
            DB::table('leads')->whereNull('user_id')->update(['user_id' => $adminId]);
        }

        // Add the foreign key constraint if the column exists and doesn't already have one
        if (Schema::hasColumn('leads', 'user_id')) {
            // Check if foreign key already exists
            $foreignKeys = Schema::getConnection()
                ->getDoctrineSchemaManager()
                ->listTableForeignKeys('leads');

            $foreignKeyExists = false;
            foreach ($foreignKeys as $foreignKey) {
                if (in_array('user_id', $foreignKey->getLocalColumns())) {
                    $foreignKeyExists = true;
                    break;
                }
            }

            if (!$foreignKeyExists) {
                Schema::table('leads', function (Blueprint $table) {
                    $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only drop the column if it exists
        if (Schema::hasColumn('leads', 'user_id')) {
            // First drop the foreign key if it exists
            $foreignKeys = Schema::getConnection()
                ->getDoctrineSchemaManager()
                ->listTableForeignKeys('leads');

            foreach ($foreignKeys as $foreignKey) {
                if (in_array('user_id', $foreignKey->getLocalColumns())) {
                    Schema::table('leads', function (Blueprint $table) use ($foreignKey) {
                        $table->dropForeign($foreignKey->getName());
                    });
                    break;
                }
            }

            // Then drop the column
            Schema::table('leads', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
    }
};

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DumpTableStructure extends Command
{
    protected $signature = 'db:dump-table {table}';
    protected $description = 'Dump the structure of a table';

    public function handle()
    {
        $table = $this->argument('table');

        if (!Schema::hasTable($table)) {
            $this->error("Table {$table} does not exist");
            return 1;
        }

        $columns = Schema::getColumnListing($table);

        $this->info("Columns in table {$table}:");
        foreach ($columns as $column) {
            $type = DB::getSchemaBuilder()->getColumnType($table, $column);
            $this->line("- {$column} ({$type})");
        }

        return 0;
    }
}

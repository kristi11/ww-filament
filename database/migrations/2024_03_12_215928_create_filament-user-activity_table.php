<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(strval(config("filament-user-activity.table.name")), function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger("user_id")->nullable();
            $table->string("url");

            $table->timestamps();
        });
    }
};

<?php

namespace Coderflex\LaravelTicket\Database\Factories;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $tableName = config('laravel_ticket.table_names.tickets', 'tickets');

        // Check if the table already exists before creating
        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->nullable();
                $table->foreignId('user_id');
                $table->string('title');
                $table->string('message')->nullable();
                $table->string('priority')->default('low');
                $table->string('status')->default('open');
                $table->boolean('is_resolved')->default(false);
                $table->boolean('is_locked')->default(false);
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        $tableName = config('laravel_ticket.table_names.tickets', 'tickets');

        Schema::dropIfExists($tableName);
    }
};

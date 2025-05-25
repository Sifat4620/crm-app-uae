<?php

namespace Coderflex\LaravelTicket\Database\Factories;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $tableNameConfig = config('laravel_ticket.table_names.messages', ['table' => 'messages', 'columns' => []]);
        $tableName = is_array($tableNameConfig) && isset($tableNameConfig['table']) ? $tableNameConfig['table'] : $tableNameConfig;

        $userColumn = $tableNameConfig['columns']['user_foreign_id'] ?? 'user_id';
        $ticketColumn = $tableNameConfig['columns']['ticket_foreign_id'] ?? 'ticket_id';

        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use ($userColumn, $ticketColumn) {
                $table->id();
                $table->foreignId($userColumn);
                $table->foreignId($ticketColumn);
                $table->text('message');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        $tableNameConfig = config('laravel_ticket.table_names.messages', ['table' => 'messages']);
        $tableName = is_array($tableNameConfig) && isset($tableNameConfig['table']) ? $tableNameConfig['table'] : $tableNameConfig;

        Schema::dropIfExists($tableName);
    }
};

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
        Schema::table("plans", function (Blueprint $table) {
            $table
            ->boolean("completed")
            ->nullable()
            ->comment("Completed flag");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function($table) {
            $table->dropColumn('completed');
        });
    }
};

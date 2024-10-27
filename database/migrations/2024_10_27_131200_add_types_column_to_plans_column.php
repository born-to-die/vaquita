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
        Schema::table("categories", function (Blueprint $table) {
            $table
            ->char("emoji", 255)
            ->nullable()
            ->comment("Emoji");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function($table) {
            $table->dropColumn('emoji');
        });
    }
};

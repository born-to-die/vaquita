<?php

use App\Models\Plan;
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
            ->char("type_name", 32)
            ->default("primary")
            ->comment("Тип категории")
            ->after("name");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function($table) {
            $table->dropColumn('type_name');
        });
    }
};

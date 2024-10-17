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
            ->tinyInteger("is_temp")
            ->default(0)
            ->comment("Временная категория")
            ->after("name");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function($table) {
            $table->dropColumn('is_temp');
        });
    }
};

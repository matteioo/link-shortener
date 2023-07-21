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
        Schema::table('links', function (Blueprint $table) {
            $table->unsignedInteger('clicks')->default(0);
            $table->unsignedInteger('duration')->default(1);
            $table->timestamp('expires_at')->default(now()->addDay());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->dropColumn('clicks');
            $table->dropColumn('duration');
            $table->dropColumn('expires_at');
        });
    }
};

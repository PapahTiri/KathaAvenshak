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
        // Schema::table('coin_topups', function (Blueprint $table) {
        //     $table->foreignId('coin_package_id')->nullable()->after('user_id')->constrained()->nullOnDelete();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('coin_topups', function (Blueprint $table) {
        //     $table->dropForeign(['coin_package_id']);
        //     $table->dropColumn('coin_package_id');
        // });
    }
};

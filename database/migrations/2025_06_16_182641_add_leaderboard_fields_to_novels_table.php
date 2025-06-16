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
        Schema::table('novels', function (Blueprint $table) {
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('likes')->default(0);
            $table->unsignedInteger('comments')->default(0);
            $table->unsignedBigInteger('earned_coins')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('novels', function (Blueprint $table) {
            if (Schema::hasColumn('novels', 'views')) {
            $table->dropColumn('views');
            }
            if (Schema::hasColumn('novels', 'likes')) {
                $table->dropColumn('likes');
            }
            if (Schema::hasColumn('novels', 'comments')) {
                $table->dropColumn('comments');
            }
            if (Schema::hasColumn('novels', 'earned_coins')) {
                $table->dropColumn('earned_coins');
            }
        });
    }
};

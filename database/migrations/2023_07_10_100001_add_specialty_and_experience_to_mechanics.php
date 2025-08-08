<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $withinTransaction = false;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
//        if (Schema::hasTable('mechanics')) {
//            Schema::table('mechanics', function (Blueprint $table) {
//                $table->string('specialty')->nullable();
//                $table->integer('experience')->nullable();
//            });
//        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        if (Schema::hasTable('mechanics')) {
//            Schema::table('mechanics', function (Blueprint $table) {
//                $table->dropColumn(['specialty', 'experience']);
//            });
//        }
    }
};
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
    public function up()
    {
        // Check if the column exists before trying to add it
        if (!Schema::hasColumn('appointments', 'time_slot')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->string('time_slot')->nullable()->after('appointment_date');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Check if the column exists before trying to drop it
        if (Schema::hasColumn('appointments', 'time_slot')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->dropColumn('time_slot');
            });
        }
    }
};

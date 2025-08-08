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
        // Check if time_slot column already exists
        if (!Schema::hasColumn('appointments', 'time_slot')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->string('time_slot')->nullable()->after('appointment_date');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We don't want to drop the column in case other migrations depend on it
        // This is just a safety migration
    }
};
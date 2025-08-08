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
        if (Schema::hasTable('contact_issues')) {
            Schema::table('contact_issues', function (Blueprint $table) {
                // Check if the name column exists and rename it to user_name
                if (Schema::hasColumn('contact_issues', 'name')) {
                    $table->renameColumn('name', 'user_name');
                } 
                // If there's no name column, add user_name
                else if (!Schema::hasColumn('contact_issues', 'user_name')) {
                    $table->string('user_name')->after('id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_issues', function (Blueprint $table) {
            if (Schema::hasColumn('contact_issues', 'user_name')) {
                $table->renameColumn('user_name', 'name');
            }
        });
    }
};
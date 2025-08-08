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
        Schema::create('contact_issues', function (Blueprint $table) {
            $table->id();
            $table->string('user_name', 191);
            $table->string('phone', 191);
            $table->string('problem_type', 191);
            $table->text('problem_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_issues');
    }
};

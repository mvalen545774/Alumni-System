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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'alumni'])->default('alumni');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('student_id')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->foreignId('degree_program_id')->nullable()->constrained()->onDelete('set null');
            $table->string('year_graduated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'status', 'student_id', 'phone', 'address', 'degree_program_id', 'year_graduated']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->dateTime('event_date');
            $table->string('location');
            $table->enum('event_type', ['reunion', 'homecoming', 'seminar', 'party', 'webinar', 'other'])->default('other');
            $table->enum('venue_type', ['in-person', 'virtual', 'hybrid'])->default('in-person');
            $table->integer('max_attendees')->nullable();
            $table->string('contact_email')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->string('rrule')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->string('title');
            $table->text('description');
            $table->string('sender');
            $table->json('recipients');
            $table->json('cc');
            $table->json('bcc');
            $table->enum('importance', ['normal', 'high']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};

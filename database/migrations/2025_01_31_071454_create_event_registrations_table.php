<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Links to users table
            $table->foreignId('event_id')->constrained()->onDelete('cascade'); // Links to events table
            $table->string('ticket_type');
            $table->integer('ticket_quantity');
            $table->string('payment_method');
            $table->string('special_requests')->nullable();
            $table->string('verification_code')->nullable(); // Stores verification code
            $table->boolean('verified')->default(false); // Tracks verification status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_registrations');
    }
};

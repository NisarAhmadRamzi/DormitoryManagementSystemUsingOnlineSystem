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
        Schema::create('fee_room', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id'); // Foreign key to rooms
            $table->unsignedBigInteger('fee_id'); // Foreign key to fees
            $table->timestamps();
    
            // Foreign key constraints
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('fee_id')->references('id')->on('fees')->onDelete('cascade');
        });
        // // Attach the fee to multiple rooms
        // $fee->rooms()->attach([$room1->id, $room2->id]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_room');
    }
};

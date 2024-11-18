<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key.
            $table->foreignId('student_id') // Foreign key to the 'students' table.
                  ->constrained('students') // Ensures this references the 'id' column in the 'students' table.
                  ->onDelete('cascade'); // Deletes complaints if the associated student is deleted.
            $table->text('description'); // Field to store the complaint description.
            $table->enum('status', ['Pending', 'Resolved']) // Enum field for complaint status.
                  ->default('Pending'); // Default value is 'Pending'.
            $table->timestamps(); // Adds 'created_at' and 'updated_at' timestamps.
        });
    }

    /**
     * Reverse the migrations.
     * This deletes the 'complaints' table.
     */
    public function down()
    {
        Schema::dropIfExists('complaints'); // Deletes the table if it exists.
    }
};

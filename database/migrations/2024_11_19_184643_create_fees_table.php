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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['Paid', 'Pending'])->default('Pending');
            $table->date('due_date');
            $table->timestamp('paid_at')->nullable(); // Null if not paid
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fees');
    }
};

<?php
// database/migrations/[timestamp]_create_student_details_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('registration_number')->unique();
            $table->boolean('has_paid')->default(false);
            $table->string('payment_reference')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->date('payment_expiry')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_details');
    }
};
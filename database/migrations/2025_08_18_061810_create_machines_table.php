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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // First create the column
            $table->unsignedBigInteger('line_id');

            // Then set the foreign key
            $table->foreign('line_id')
                  ->references('id')
                  ->on('production_lines')
                  ->onDelete('cascade');
            $table->string('description')->nullable();
            $table->enum('status', ['running', 'stopped'])->default('idle');

            $table->timestamps();
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};

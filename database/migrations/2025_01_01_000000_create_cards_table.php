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
        Schema::create('cards', function (Blueprint $table) {
           $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('author');
            $table->string('title');
            $table->enum('type', ['share', 'wish']);
            $table->enum('status', ['pending', 'approved', 'rejected', 'archived'])->default('pending');
            $table->text('reason')->nullable();
            
            $table->string('publisher')->nullable();
            $table->integer('year')->nullable();
            $table->string('binding')->nullable();
            $table->string('condition')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};

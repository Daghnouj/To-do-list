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
        Schema::create('tasks', function (Blueprint $table) {

        $table->id();
        $table->string('title'); 
        $table->text('description')->nullable(); 
        $table->integer('priority')->default(3);
        $table->date('due_date')->nullable(); 
        $table->boolean('is_important')->default(false); 
        $table->enum('status', ['pending', 'completed'])->default('pending');
        $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

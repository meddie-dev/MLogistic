<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('vehicle_inventory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('name');
            $table->string('image');
            $table->string('model'); 
            $table->string('color');
            $table->string('license_plate')->unique(); 
            $table->integer('year'); 
            $table->enum('status', ['available', 'in-use', 'maintenance'])->default('available');
            $table->enum('condition', ['good', 'fair', 'poor'])->default('good');
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_inventory');
    }
};

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
        Schema::table('vehicle_inventory', function (Blueprint $table) {
            $table->dateTime('last_maintenance')->nullable();
            $table->dateTime('next_maintenance_due')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('vehicle_inventory', function (Blueprint $table) {
            $table->dropColumn(['last_maintenance', 'next_maintenance_due']);
        });
    }
    
};

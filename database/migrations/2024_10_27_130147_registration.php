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
        Schema::create('registration', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            $table->string('company_name');
            $table->string('company_address');
            $table->string('company_email')->unique();
            $table->text('service_offerings');
            $table->text('key_contacts');
            $table->string('supporting_documents_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registration');
    }
};

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
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->boolean('membership_required')->default(0);
            $table->string('description_ar');
            $table->string('description_en')->nullable();
            $table->string('target_audience_ar')->nullable();
            $table->string('target_audience_en')->nullable();
            $table->string('required_documents_ar')->nullable();
            $table->string('required_documents_en')->nullable();
            $table->string('image')->nullable();
            $table->string('service_charter_ar')->nullable();
            $table->string('service_charter_en')->nullable();
            $table->string('disclaimer_ar')->nullable();
            $table->string('disclaimer_en')->nullable();
            $table->string('chanel')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('is_payed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

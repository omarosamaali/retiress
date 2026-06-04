<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('services')) {
            return;
        }

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->boolean('membership_required')->default(false);
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->text('target_audience_ar')->nullable();
            $table->text('target_audience_en')->nullable();
            $table->text('required_documents_ar')->nullable();
            $table->text('required_documents_en')->nullable();
            $table->text('service_charter_ar')->nullable();
            $table->text('service_charter_en')->nullable();
            $table->text('disclaimer_ar')->nullable();
            $table->text('disclaimer_en')->nullable();
            $table->string('image')->nullable();
            $table->string('chanel')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('is_payed')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

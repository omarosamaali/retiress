<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('features', function (Blueprint $table) {
            $table->id();

            $table->string('title_ar');
            $table->string('title_en')->nullable();
            $table->text('description_ar');
            $table->text('description_en')->nullable();

            // إضافة المفتاح الأجنبي member_id
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('member_applications')->onDelete('cascade');

            $table->string('main_image')->nullable();
            $table->json('sub_image')->nullable();
            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('features');
    }
};
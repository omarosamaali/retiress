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
        Schema::create('member_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User ID إلزامي

            $table->string('membership_number', 5)->unique(); // 5-digit unique membership number            
            $table->string('full_name');
            $table->string('nationality');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('emirate');
            $table->string('marital_status');
            $table->string('national_id')->unique();
            $table->string('educational_qualification');
            $table->enum('status', [0, 1, 2, 3, 4])->default(0);
            $table->timestamp('expiration_date')->nullable();
            // مسارات صور المستندات
            $table->string('passport_photo_path')->nullable();
            $table->string('national_id_photo_path')->nullable();
            $table->string('personal_photo_path')->nullable();
            $table->string('educational_qualification_photo_path')->nullable();
            $table->string('retirement_card_photo_path')->nullable();
            $table->string('front_id')->nullable();
            $table->string('back_id')->nullable();

            // بيانات التواصل
            $table->string('mobile_phone');
            $table->string('home_phone')->nullable();
            $table->string('email');
            $table->string('po_box')->nullable();

            // بيانات التقاعد
            $table->date('retirement_date')->nullable();
            $table->string('contract_type')->nullable(); // نظامي/مبكر
            $table->text('early_reason')->nullable(); // سبب التعاقد المبكر

            // عمود JSON لتخزين الخبرات المهنية
            $table->json('professional_experiences')->nullable();
            $table->json('previous_experience')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_applications');
    }
};

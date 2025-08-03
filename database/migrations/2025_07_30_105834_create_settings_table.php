<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('address', 500)->nullable()->comment('العنوان');
            $table->string('office_number', 100)->nullable()->comment('رقم المكتب');
            $table->string('whatsapp', 20)->nullable()->comment('رقم الواتس آب');
            $table->string('email')->nullable()->comment('البريد الإلكتروني');
            $table->text('work_days')->nullable()->comment('أيام العمل');
            $table->text('holidays')->nullable()->comment('أيام العطل الرسمية');
            $table->string('facebook_url', 500)->nullable()->comment('رابط فيسبوك');
            $table->string('instagram_url', 500)->nullable()->comment('رابط انستجرام');
            $table->string('youtube_url', 500)->nullable()->comment('رابط يوتيوب');
            $table->string('tiktok_url', 500)->nullable()->comment('رابط تيك توك');
            $table->string('ios_url', 500)->nullable()->comment('رابط ios');
            $table->string('android_url', 500)->nullable()->comment('رابط android');
            $table->boolean('is_active')->default(true)->comment('حالة التفعيل');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
};

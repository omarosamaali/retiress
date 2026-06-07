<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // إضافة 'خدمات' للـ ENUM وحذف 'مميزات' التي لم تكن في الـ DB أصلاً
        DB::statement("ALTER TABLE `events` MODIFY `type` ENUM('فعالية','دورة','محاضرة','خدمات') NOT NULL DEFAULT 'فعالية'");

        // تحديث أي سجلات قديمة تحمل 'مميزات' إلى 'خدمات' (احتياطاً)
        DB::table('events')->where('type', 'مميزات')->update(['type' => 'خدمات']);
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE `events` MODIFY `type` ENUM('فعالية','دورة','محاضرة') NOT NULL DEFAULT 'فعالية'");
    }
};

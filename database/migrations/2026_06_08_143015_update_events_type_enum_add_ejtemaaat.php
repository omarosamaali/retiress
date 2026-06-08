<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE `events` MODIFY `type` ENUM('فعالية','دورة','محاضرة','خدمات','اجتماعات') NOT NULL DEFAULT 'فعالية'");
    }

    public function down(): void
    {
        DB::table('events')->where('type', 'اجتماعات')->update(['type' => 'فعالية']);
        DB::statement("ALTER TABLE `events` MODIFY `type` ENUM('فعالية','دورة','محاضرة','خدمات') NOT NULL DEFAULT 'فعالية'");
    }
};

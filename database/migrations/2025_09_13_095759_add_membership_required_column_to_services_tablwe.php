<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('services') || Schema::hasColumn('services', 'membership_required')) {
            return;
        }

        Schema::table('services', function (Blueprint $table) {
            $table->boolean('membership_required')->default(false);
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('services') || ! Schema::hasColumn('services', 'membership_required')) {
            return;
        }

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('membership_required');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dateTime('starts_at')->nullable()->after('price');
            $table->dateTime('ends_at')->nullable()->after('starts_at');
        });

        DB::table('events')->whereNull('starts_at')->update([
            'starts_at' => DB::raw('created_at'),
        ]);
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['starts_at', 'ends_at']);
        });
    }
};

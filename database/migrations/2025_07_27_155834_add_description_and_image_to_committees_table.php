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
        Schema::table('councils', function (Blueprint $table) {
            $table->longText('description_ar')->nullable()->after('name_en'); // أو بعد أي عمود آخر مناسب
            $table->longText('description_en')->nullable()->after('description_ar');
            $table->string('image')->nullable()->after('description_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('councils', function (Blueprint $table) {
            $table->dropColumn(['description_ar', 'description_en', 'image']);
        });
    }
};

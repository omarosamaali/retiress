<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('member_applications', function (Blueprint $table) {
            $table->string('membership_number', 50)->change(); // زيادة الحجم إلى 50
        });
    }

    public function down()
    {
        Schema::table('member_applications', function (Blueprint $table) {
            $table->string('membership_number', 10)->change(); // العودة للحجم القديم
        });
    }
};

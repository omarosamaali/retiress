<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('member_applications', function (Blueprint $table) {
            $table->dropUnique('member_applications_national_id_unique');
            // أو
            // $table->dropUnique(['national_id']);
        });
    }

    public function down()
    {
        Schema::table('member_applications', function (Blueprint $table) {
            $table->unique('national_id');
        });
    }
};

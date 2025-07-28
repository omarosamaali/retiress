<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('section')->unique(); // اسم القسم (مثل membership_description, privileges)
            $table->string('title_ar'); // العنوان بالعربية
            $table->string('title_en'); // العنوان بالإنجليزية
            $table->text('description_ar'); // الوصف بالعربية
            $table->text('description_en'); // الوصف بالإنجليزية
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('memberships');
    }
};

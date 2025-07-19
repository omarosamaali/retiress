<?php

use App\Models\Committee;
use App\Models\Council;
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
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            $table->string('name_ar');
            $table->string('name_en');
            $table->string('position_ar');
            $table->string('position_en');
            $table->string('image')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignIdFor(Committee::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Council::class)->nullable()->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};

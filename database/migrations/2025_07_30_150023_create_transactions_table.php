<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    // database/migrations/YYYY_MM_DD_HHMMSS_create_transactions_table.php

    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // هنا يجب أن يكون service_id يسمح بقيم فارغة
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('cascade');
            // و event_id أيضًا
            $table->foreignId('event_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('status');
            $table->string('type');
            $table->timestamp('subscribed_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

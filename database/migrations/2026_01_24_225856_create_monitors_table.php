<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->boolean('error_send_email')->default(false);

            $table->timestamp('last_checked_at')->nullable();
            $table->enum('last_check_status', ['up', 'down', 'maintenance'])->nullable();
            $table->integer('last_response_time_ms')->nullable();

            $table->integer('frequency_seconds')->default(60);
            $table->enum('monitoring_status', ['active', 'paused'])->default('active');

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('monitors');
    }
};

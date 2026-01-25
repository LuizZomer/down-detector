<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('uptime_checks', function (Blueprint $table) {
            $table->id();
            $table->integer('response_time_ms')->nullable();
            $table->enum('status', ['up', 'down', 'maintenance']);
            $table->smallInteger('http_status_code')->nullable();
            $table->string('reason')->nullable();

            $table->foreignId('monitor_id')
                ->constrained('monitors')
                ->cascadeOnDelete();

            $table->timestamp('created_at')->useCurrent();

            $table->index(['monitor_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uptime_checks');
    }
};

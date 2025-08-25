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
        Schema::table('event_users', function (Blueprint $table) {
            $table->foreignId('payment_id')
                ->nullable()
                ->constrained('payments')
                ->onDelete('set null');
        });

        Schema::table('memberships', function (Blueprint $table) {
            $table->foreignId('payment_id')
                ->nullable()
                ->constrained('payments')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('payment_id');
        });

        Schema::table('memberships', function (Blueprint $table) {
            $table->dropConstrainedForeignId('payment_id');
        });
    }
};

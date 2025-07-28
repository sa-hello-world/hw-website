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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('location');
            $table->string('poster_path')->nullable();
            $table->string('banner_path')->nullable();
            $table->integer('available_places')->nullable();
            $table->dateTime('start');
            $table->dateTime('end')->nullable();
            $table->integer('regular_price')->nullable();
            $table->integer('member_price')->nullable();
            $table->string('type');
            $table->string('open_for')->nullable();
            $table->unsignedBigInteger('school_year_id')->nullable();
            $table->foreign('school_year_id')->references('id')->on('school_years')
                ->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

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
            $table->string('title');
            $table->string('slug')->nullable()->unique();
            $table->text('content');
            $table->string('lieu')->nullable();
            $table->string('tel')->nullable();
            $table->string('email')->nullable();
            $table->date('dat_event')->nullable();

            $table->foreignId('user_id');
            $table->boolean('approved')->default(true);
            $table->boolean('readable')->default(false)->nullable();
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

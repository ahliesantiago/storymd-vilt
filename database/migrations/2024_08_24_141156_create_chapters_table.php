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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id')->constrained()->onDelete('cascade');
            $table->integer('position');
            $table->string('chapter_title')->nullable();
            $table->longtext('content');
            $table->string('summary', 1250);
            $table->string('beginning_notes', 5000)->nullable();
            $table->string('end_notes', 5000)->nullable();
            $table->integer('word_count');
            $table->datetime('published_at');
            $table->datetime('revised_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};

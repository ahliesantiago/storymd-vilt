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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('creator_id')->nullable()->constrained(table: 'users', indexName: 'id')->onDelete('set null');
            $table->boolean('is_published')->default(false);
            $table->boolean('is_private')->default(false);
            $table->boolean('is_complete')->default(false);
            $table->string('summary', 1250);
            $table->integer('expected_chapter_count')->nullable();
            $table->foreignId('language_id')->nullable()->constrained()->onDelete('set null');
            $table->boolean('is_commenting_allowed')->default(true);
            $table->boolean('is_comment_moderated')->default(false);
            $table->foreignId('fandom_id')->constrained()->onDelete('restrict');
            $table->integer('word_count');
            $table->foreignId('rating')->constrained()->onDelete('restrict');
            $table->datetime('published_at');
            $table->datetime('revised_at');
            $table->datetime('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};

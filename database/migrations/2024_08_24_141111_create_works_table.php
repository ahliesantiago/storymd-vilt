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
            $table->boolean('privacy')->default('public');
            $table->boolean('is_complete')->default(false);
            $table->integer('expected_chapter_count')->nullable();
            $table->boolean('commenting_rule')->default('registered_only');
            $table->boolean('is_comment_moderated')->default(false);
            $table->integer('word_count');
            $table->foreign('language_code')->nullable()->references('language_code')->on('languages')->onDelete('set null');
            $table->foreignId('rating_id')->constrained()->onDelete('restrict');
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

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
      Schema::create('work_warnings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('work_id')->constrained()->onDelete('restrict');
        $table->foreignId('warning_id')->constrained()->onDelete('restrict');
        $table->timestamps();
      });
      Schema::create('tags', function (Blueprint $table) {
          $table->id();
          $table->string('tag_name');
          $table->string('type');
          $table->boolean('is_canonical')->default(false);
          $table->integer('merger_id')->nullable();
          $table->foreignId('fandom_id')->nullable()->constrained()->onDelete('cascade');
          $table->timestamps();
      });
      Schema::create('work_tags', function (Blueprint $table) {
        $table->id();
        $table->foreignId('work_id')->constrained()->onDelete('no action');
        $table->foreignId('tag_id')->constrained()->onDelete('no action');
        $table->boolean('is_major')->default(false);
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('work_warnings');
      Schema::dropIfExists('tags');
      Schema::dropIfExists('work_tags');
    }
};

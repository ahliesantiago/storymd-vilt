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
      Schema::table('works', function (Blueprint $table) {
        $table->dropForeign(['fandom_id']);
        $table->dropColumn('fandom_id');
      });

      Schema::create('work_categories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('work_id')->constrained()->onDelete('restrict');
        $table->foreignId('category_id')->constrained()->onDelete('restrict');
        $table->timestamps();
    });

      Schema::create('work_fandoms', function (Blueprint $table) {
        $table->id();
        $table->foreignId('work_id')->constrained()->onDelete('no action');
        $table->foreignId('fandom_id')->constrained()->onDelete('no action');
        $table->boolean('is_major')->default(false);
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('work_categories');
      Schema::dropIfExists('work_fandoms');
    }
};

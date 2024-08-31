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
        $table->foreignId('warning_id')->default(1)->constrained()->onDelete('restrict');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

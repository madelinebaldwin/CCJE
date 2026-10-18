<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('academic_year', 20);
            $table->string('year_level', 30);
            $table->string('section', 50);
            $table->unsignedInteger('total_students')->default(0);
            $table->timestamps();
            $table->unique(['academic_year', 'year_level', 'section']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};

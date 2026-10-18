<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('event_date');
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->decimal('approved_budget', 12, 2)->default(0);
            $table->string('academic_year', 20);
            $table->enum('status', ['Planned', 'Ongoing', 'Completed'])->default('Planned');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

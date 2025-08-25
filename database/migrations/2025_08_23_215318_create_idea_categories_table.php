<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('idea_categories', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->unique();
            $table->string('name')->index();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('color')->nullable()->default('#6b7280');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('idea_categories');
    }
};

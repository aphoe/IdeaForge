<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('idea_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Idea::class)->constrained()->cascadeOnDelete();
            $table->string('identifier')->unique();
            $table->double('score');
            $table->json('criteria');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('idea_scores');
    }
};

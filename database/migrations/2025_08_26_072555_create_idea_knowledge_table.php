<?php

use App\Models\Idea;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('idea_knowledge', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Idea::class)->constrained()->cascadeOnDelete();
            $table->string('identifier');
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('progress')->default(0);
            $table->string('status')->default(\App\Enums\ProgressStatus::NOT_STARTED->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('idea_knowledge');
    }
};

<?php

use App\Models\Idea;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('idea_features', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Idea::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('feature');
            $table->string('status')->default(\App\Enums\IdeaStatus::DRAFT->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('idea_features');
    }
};

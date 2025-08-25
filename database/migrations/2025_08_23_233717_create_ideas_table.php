<?php

use App\Models\IdeaCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IdeaCategory::class)->nullable()->constrained()->nullOnDelete();
            $table->string('identifier')->unique();
            $table->string('title')->index();
            $table->string('slug')->unique();
            $table->string('domain_name')->nullable();
            $table->string('brand_name')->nullable();
            $table->text('description');
            $table->text('problem');
            $table->text('notes')->nullable();
            $table->string('status')->default(\App\Enums\IdeaStatus::DRAFT->value);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};

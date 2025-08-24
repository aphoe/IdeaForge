<?php

use App\Models\Idea;
use App\Services\IdeaService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ideas', function (Blueprint $table) {
            $table->string('code')->nullable()->after('slug');
        });

        $service = new IdeaService();
        foreach(Idea::whereNull('code')->get() as $idea) {
            $idea->code = $service->genCode($idea->title);
            $idea->save();
        }

        Schema::table('ideas', function (Blueprint $table) {
            $table->string('code', 15)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('ideas', function (Blueprint $table) {
            $table->dropColumn('code');
        });
    }
};

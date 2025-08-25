<?php

use App\Models\IdeaFeature;
use App\Services\IdeaFeatureService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('idea_features', function (Blueprint $table) {
            $table->string('code')->nullable()->after('title');
        });

        $service = new IdeaFeatureService();
        foreach (IdeaFeature::whereNull('code')->get() as $feature){
            $feature->code = $service->genCode($feature->idea);
            $feature->save();
        }

        Schema::table('idea_features', function (Blueprint $table) {
            $table->string('code', 15)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('idea_features', function (Blueprint $table) {
            $table->dropColumn('code');
        });
    }
};

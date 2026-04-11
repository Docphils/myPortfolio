<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('is_published')->default(true)->after('link');
            $table->boolean('is_featured')->default(true)->after('is_published');
            $table->timestamp('published_at')->nullable()->after('is_featured');

            $table->index(['is_published', 'is_featured']);
            $table->index('published_at');
        });

        DB::table('projects')
            ->whereNull('published_at')
            ->update([
                'published_at' => DB::raw('created_at'),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['is_published', 'is_featured']);
            $table->dropIndex(['published_at']);

            $table->dropColumn(['is_published', 'is_featured', 'published_at']);
        });
    }
};

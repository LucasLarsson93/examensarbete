<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Rename post_by column to user_id
            $table->renameColumn('post_by', 'user_id');

            // Rename post_topic column to topic_id
            $table->renameColumn('post_topic', 'topic_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Revert column changes if rollback is needed
            $table->renameColumn('user_id', 'post_by');
            $table->renameColumn('topic_id', 'post_topic');
        });
    }
};

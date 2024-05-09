<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePostIdToIdInPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('post_id', 'id');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('id', 'post_id');
        });
    }
}
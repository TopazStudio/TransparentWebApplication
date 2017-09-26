<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToTopicJoinedUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topic_joined_users', function (Blueprint $table) {
            $table->foreign('userId')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('topicId')
                ->references('id')->on('topics')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topic_joined_users', function (Blueprint $table) {
            //
        });
    }
}

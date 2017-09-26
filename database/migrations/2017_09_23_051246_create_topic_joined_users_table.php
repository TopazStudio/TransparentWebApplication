<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicJoinedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_joined_users', function (Blueprint $table) {
            $table->increments('id');

            //relationship
            $table->unsignedInteger('topicId');
            $table->unsignedInteger('userId');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topic_users');
    }
}

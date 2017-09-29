<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToCompanyRelatedTopics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_related_topics', function (Blueprint $table) {
            $table->foreign('companyId')
                ->references('id')->on('companies')
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
        Schema::table('company_related_topics', function (Blueprint $table) {
            //
        });
    }
}

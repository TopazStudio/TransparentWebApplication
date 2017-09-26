<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToCompanyRelatedBlogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_related_blogs', function (Blueprint $table) {
            $table->foreign('blogId')
                ->references('id')->on('blogs')
                ->onDelete('cascade');

            $table->foreign('companyId')
                ->references('id')->on('companies')
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
        Schema::table('company_related_blogs', function (Blueprint $table) {
            //
        });
    }
}

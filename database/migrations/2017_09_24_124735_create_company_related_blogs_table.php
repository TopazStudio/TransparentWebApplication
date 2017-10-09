<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyRelatedBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *bl
     * @return void
     */
    public function up()
    {
        Schema::create('company_related_blogs', function (Blueprint $table) {
            $table->increments('id');

            //relationship
            $table->unsignedInteger('blogId');
            $table->unsignedInteger('companyId');

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
        Schema::dropIfExists('company_related_blogs');
    }
}

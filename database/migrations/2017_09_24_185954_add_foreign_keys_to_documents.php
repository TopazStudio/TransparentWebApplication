<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('userId')
                ->references('id')->on('users')
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
        Schema::table('documents', function (Blueprint $table) {
            //
        });
    }
}

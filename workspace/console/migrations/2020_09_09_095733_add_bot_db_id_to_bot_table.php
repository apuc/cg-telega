<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddBotDbIdToBotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->table('bot', function (Blueprint $table) {
            $table->integer('db_id')->unsigned();
            $table->foreign('db_id')->references('id')->on('bot_db');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        App::$db->schema->table('bot', function ($table) {
            $table->dropForeign(['db_id']);
        });
    }
}

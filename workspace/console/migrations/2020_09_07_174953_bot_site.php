<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class BotSite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->create('bot_site', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id')->unsigned();
            $table->foreign('site_id')->references('id')->on('site');
            $table->integer('bot_id')->unsigned();
            $table->foreign('bot_id')->references('id')->on('bot');
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
        App::$db->schema->table('bot_site', function ($table) {
            $table->dropForeign(['site_id']);
        });
        App::$db->schema->table('bot_site', function ($table) {
            $table->dropForeign(['bot_id']);
        });
        App::$db->schema->dropIfExists('bot_site');
    }
}

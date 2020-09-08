<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->create('bot', function (Blueprint $table) {
            $table->increments('id');
            $table->text('bot_username')->nullable(false);
            $table->text('api_token')->nullable(false);
            $table->text('webhook_url')->nullable(false);
            $table->boolean('is_available');
//            $table->integer('site_id')->unsigned();
//            $table->foreign('site_id')->references('id')->on('site');;
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
//        App::$db->schema->table('bot', function ($table) {
//            $table->dropForeign(['site_id']);
//        });
        App::$db->schema->dropIfExists('bot');
    }
}

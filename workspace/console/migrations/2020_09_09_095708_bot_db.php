<?php

use core\App;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BotDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App::$db->schema->create('bot_db', function (Blueprint $table) {
            $table->increments('id');
            $table->text('host')->nullable(false);
            $table->text('user')->nullable(false);
            $table->text('password')->nullable(false);
            $table->text('database')->nullable(false);
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
        App::$db->schema->dropIfExists('bot_db');
    }
}

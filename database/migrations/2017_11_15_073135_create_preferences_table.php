<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences', function (Blueprint $table) {
            $table->increments('id');

            $table->boolean('isDownload');
            $table->enum('visibility', ['private', 'public', 'hidden']);
            $table->enum('sort', ['name', 'created_at', 'shoot_at']);

            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(
            'preferences',
            function (Blueprint $table) {
                $table->dropForeign('preferences_user_id_foreign');
            }
        );
    }
}

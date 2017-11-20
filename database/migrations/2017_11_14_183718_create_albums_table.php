<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'albums',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 100);
                $table->string('description', 1000)->nullable();
                $table->integer('user_id')->unsigned();
                $table->timestamps();
                $table->boolean('isDownload');
                $table->enum('visibility', ['private', 'public', 'hidden']);
                $table->enum('sort', ['name', 'created_at', 'shoot_at']);

                $table->foreign('user_id')->references('id')->on('users');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(
            'albums',
            function (Blueprint $table) {
                $table->dropForeign('albums_user_id_foreign');
            }
        );
    }
}

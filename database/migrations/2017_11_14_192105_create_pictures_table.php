<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'pictures',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('title', 100)->nullable();
                $table->string('description', 1000)->nullable();
                $table->integer('iso')->nullable();
                $table->string('shutter', 30)->nullable();
                $table->string('aperture', 20)->nullable();
                $table->string('focal', 20)->nullable();
                $table->string('make', 100)->nullable();
                $table->string('model', 100)->nullable();
                $table->dateTime('shoot_at')->nullable();
                $table->integer('width');
                $table->integer('height');
                $table->string('type', 10);
                $table->string('size', 20);
                $table->string('url', 100);
                $table->string('thumbUrl', 100);
                $table->char('checksum', 40);
                $table->tinyInteger('note');
                $table->boolean('fav');
                $table->json('exif');
                $table->boolean('isDownload');
                $table->enum('visibility', ['private', 'public', 'hidden']);
                $table->timestamps();
                $table->integer('album_id')->unsigned()->nullable();

                $table->index('album_id');
                $table->foreign('album_id')->references('id')->on('users');
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
            'pictures',
            function (Blueprint $table) {
                    $table->dropIndex('pictures_album_index');
                $table->dropForeign('pictures_album_id_foreign');
            }
        );
    }
}

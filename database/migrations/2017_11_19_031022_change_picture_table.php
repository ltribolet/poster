<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePictureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->dropColumn('note');
            $table->dropColumn('fav');
            $table->dropColumn('thumbUrl');
        });

        Schema::table('pictures', function (Blueprint $table) {
            $table->tinyInteger('note')->nullable();
            $table->boolean('fav')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

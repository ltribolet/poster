<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPreferencesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('isDownload')->default(false);
            $table->enum('visibility', ['private', 'public', 'hidden'])->default('private');
            $table->enum('sort_album', ['name', 'created_at'])->default('created_at');
            $table->enum('sort_pictures', ['name', 'created_at', 'shoot_at'])->default('created_at');
            $table->boolean('isAdmin')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['isDownload', 'visibility', 'sort_album', 'sort_pictures', 'isAdmin']);
        });
    }
}

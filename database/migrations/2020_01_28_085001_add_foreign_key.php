<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_tag', function (Blueprint $table) {

          $table -> bigInteger('post_id') -> unsigned() -> index();
          $table -> foreign('post_id', 'post_tag_post_id')
                 -> references('id')
                 -> on('posts');

          $table -> bigInteger('tag_id') -> unsigned() -> index();
          $table -> foreign('tag_id', 'post_tag_tag_id')
                 -> references('id')
                 -> on('tags');
        });

        Schema::table('posts', function (Blueprint $table) {

            $table -> bigInteger('user_id') -> unsigned() -> index();
            $table -> foreign('user_id', 'post_user_id')
                   -> references('id')
                   -> on('users');
        });

        Schema::table('user_infos', function (Blueprint $table) {

          $table -> bigInteger('user_id') -> unsigned() -> index();
          $table -> foreign('user_id', 'user_info_user_id')
                 -> references('id')
                 -> on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_tag', function (Blueprint $table) {

          $table -> dropForeign('post_tag_post_id');
          $table -> dropForeign('post_tag_tag_id');

          $table -> dropColumn('post_id');
          $table -> dropColumn('tag_id');
        });

        Schema::table('posts', function (Blueprint $table) {

          $table -> dropForeign('post_user_id');
          $table -> dropColumn('user_id');
        });

        Schema::table('user_infos', function (Blueprint $table) {

          $table -> dropForeign('user_info_user_id');
          $table -> dropColumn('user_id');
        });
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Tag;
use App\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Post::class, 100)
        //       -> create()
        //       -> each(function($post) {
        //
        //   $tags = Tag::inRandomOrder() -> take(rand(0,3)) -> get();
        //   $post -> tags() -> attach($tags);
        //
        // });

        factory(Post::class, 100)
              -> make()
              -> each(function($post) {

          $user = User::inRandomOrder() -> first();
          $post -> user() -> associate($user);
          $post -> save();

          $tags = Tag::inRandomOrder() -> take(rand(0,3)) -> get();
          $post -> tags() -> attach($tags);

        });
    }
}

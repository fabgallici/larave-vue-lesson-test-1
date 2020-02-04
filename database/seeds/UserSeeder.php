<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserInfo;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(User::class, 20) -> create() -> each(function($user) {

        $userInfo = factory(UserInfo::class) -> make();
        $userInfo -> user() -> associate($user);
        $userInfo -> save();
      });
    }
}

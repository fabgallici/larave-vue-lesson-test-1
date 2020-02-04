<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [

      'title',
      'body'

    ];

    public function tags() {

      return $this -> belongsToMany(Tag::class);
    }

    public function user() {

      return $this -> belongsTo(User::class);
    }
}

<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use App\User;


class Post extends Model
{
    use Searchable;
    
    
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}

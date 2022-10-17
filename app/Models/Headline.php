<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headline extends Model
{
    use HasFactory;
    public function posts()
    {
      return $this->hasMany(Post_headline::class,'headline_id','title');
    }
}

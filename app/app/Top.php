<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Top extends Model
{
    protected $fillable = ['user_id', 'name', 'price','image','discription','is_visible'];

}

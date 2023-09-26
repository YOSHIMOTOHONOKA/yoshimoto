<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['id', 'title', 'comment'];

    public function product() {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


}

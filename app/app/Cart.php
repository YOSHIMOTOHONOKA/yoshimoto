<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
    protected $fillable = ['id','quantity','status'];

    public function product() {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}

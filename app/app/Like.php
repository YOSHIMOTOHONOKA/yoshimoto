<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['id','product_id','user_id'];

    public function product() {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function like_exist($id, $product_id) {
        return $this->where([['user_id',$id],['product_id',$product_id]])->exists();
    }

}

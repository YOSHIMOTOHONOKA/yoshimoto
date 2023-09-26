<?php

namespace App;
use App\Like;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['user_id', 'name', 'price','image','discription','quantity','is_visible','title','comment','id'];

    protected $casts = [
        'price' => 'integer'
    ];


    protected $hidden = [
        'user_id', 'name', 'price','image','discription','is_visible'
    ];

    public function like() {
        return $this->belongsTo('App\Like', 'like_id', 'id');
    }

    Public function products()
  {
    //  Appフォルダに格納されているProductsモデルのデータをリレーションする
    return $this->hasOne('App\Product', 'product_id', 'id');

}
public function getlike($product_id) {
    $id = Auth::id();
    return Like::where('product_id' ,$product_id)->where('user_id', $id)->first();
}

// Product.php内
public function reviews()
{
    return $this->hasMany(Review::class);
}


}

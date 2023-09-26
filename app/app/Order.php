<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $fillable = ['id', 'address', 'quantity','mailaddress','postcode','name','created_at'];

    public function product() {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Order;
use App\Cart;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // ログインユーザーのIDを取得
        $user_id = Auth::id();
    
        // ログインユーザーに関連付けられたカートアイテムを取得
        $item = Cart::where('user_id', $user_id)->get();
        
        // ビューにデータを渡して表示
        return view('orders.order', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ログインユーザーのIDを取得
        $user_id = Auth::id();
        $products = Cart::where('user_id', $user_id)->get();
        // カート内の各商品に対して注文を作成
        foreach ($products as $product) {
            $order = new Order;
            $columns = ['name', 'address', 'mailaddress', 'postcode'];
            foreach ((array)$columns as $column) {
                $order->$column = $request->$column;
            }
    
            // 商品ごとの情報を設定
            $product_id = $product['product_id'];
            $cart_id = $product['id'];

            $order->product_id = $product_id;

            $items = Cart::where('id', $cart_id)->first();
            $items->delete();


            // その他の設定
            $order->quantity = 1;
            $order->user_id = $user_id;
    
            // データベースに保存
            $order->save();
        }
    
        return redirect('/carts');
    }
                /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Cart::find($id);
        // 記事編集画面を表示
        return view('orders.order', ['order' => $item]); // 'order' の代わりに 'item' を使用するか、ここを 'item' に変更します
    }
        
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart; // トレイトの名前と正しい名前空間を指定
use App\User;

use Illuminate\Support\Facades\Auth;
class CartController extends Controller
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
        return view('carts.cart', compact('item'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

                // ログインユーザーのIDを取得
                $user_id = Auth::id();
    
                // ログインユーザーに関連付けられたカートアイテムを取得
                $item = Cart::where('user_id', $user_id)->get();
        return view('orders.order', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function show(Request $request ,$id)
     {
         // ログインユーザーのIDを取得
         $user_id = Auth::id();
         $product = Product::find($id); // 商品情報を取得
     
         // 新しいカートアイテムを作成
         $cartItem = new \App\Cart(); // 正しい名前空間を指定
         $cartItem->product_id = $id;
         $cartItem->quantity = 1; // デフォルトの数量を設定
         $cartItem->user_id = $user_id; // デフォルトの数量を設定
     
         // カートアイテムをデータベースに保存
         $cartItem->save();
     
         // カートアイテムの詳細ビューを表示
         return redirect('/');

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
    public function destroy(Request $request, $id)
    {
        $item = Cart::find($id); 
        $item->delete();
        return redirect('/');

    }
}

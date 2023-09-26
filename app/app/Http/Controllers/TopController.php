<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Like;
use App\User;
use App\Review;


use Illuminate\Support\Facades\Auth;
class TopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = User::all();
        $keyword = $request->input('keyword');
        $from = $request->input('from'); // 開始金額範囲
        $until = $request->input('until'); // 終了金額範囲
        // 商品検索クエリの基本部分
        $productQuery = Product::query();
    
        // キーワード検索条件の追加
        if (!empty($keyword)) {
            $productQuery->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('description', 'LIKE', "%{$keyword}%");
            });
        }

        // 金額範囲検索条件の追加
        if (!empty($from)) {
            $productQuery->where('price', '>=', $from);
        }

        if (!empty($until)) {
            $productQuery->where('price', '<=', $until);
        }

        // is_visible の条件を追加
        $productQuery->where('is_visible', 1);
    
        // 商品データを取得
        $products = $productQuery->get();

        return view('top', compact('products', 'from', 'until'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
// 商品詳細を表示するコントローラー内で
public function show($id)
{
    $item = Product::find($id);
    $reviews = Review::where('product_id', $id)->get(); // 商品に関連するすべてのレビューを取得

    
    // 記事編集画面を表示
    return view('details.detail', compact('item','reviews')); // ここを追記

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Responsez
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
    public function ajaxlike(Request $request)
    {
        $id = Auth::id();
        $product_id = $request->product_id;
        $like = new Like;
        $product = Product::findOrFail($product_id);
        // 空でない（既にいいねしている）なら
        if ($like->like_exist($id, $product_id)) {
            //likesテーブルのレコードを削除
            $like = Like::where('product_id', $product_id)->where('user_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like = new Like;
            $like->product_id = $request->product_id;
            $like->user_id = Auth::id();
            $like->save();
        }

        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        // $productLikesCount = $product->loadCount('likes')->likes_count;

        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        // $json = [
        //     'productLikesCount' => $productLikesCount,
        // ];
        //下記の記述でajaxに引数の値を返す
        return response()->json();
    }

}


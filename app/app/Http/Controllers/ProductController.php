<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Like;
use App\User;
use App\Order;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests\CreateData;

use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         // すべての記事を取得
         $products = Product::all(); 

        $item = Order::all();

         $user_id = User::all(); 
         
         return view('homes.home', compact('products','user_id','item')); 
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.product');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateData $request)
    {
        $product = new Product;

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        // $product->user_id = 1;

        if ($request->hasFile('image')) {
            $dir = 'image';
             // アップロードされたファイル名を取得
           $jpg = $request->file('image')->getClientOriginalName();

            // imageディレクトリに画像を保存
            $request->file('image')->storeAs('public/' . $dir, $jpg);
            $product->image = $jpg;
        }
        $product->save();

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/products');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // editメソッドの部分のみ抜粋
    public function edit(Int $id)
    {

    // ビューから渡されたIDの記事を取得
    $product = Product::find($id);
    // 記事編集画面を表示
    return view('products.product_edit', compact('product')); // ここを追記


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // updateメソッドの部分のみ抜粋
    public function update(Product $product, CreateData $request)
    {
        // 製品が存在しない場合、適切なエラーハンドリングを行うことが重要です
        if (!$product) {
            // 例: 製品が存在しない場合のリダイレクトまたはエラーメッセージを設定
            return redirect('/products');
        }
    
        // フォームデータを使用して製品属性を更新
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
    
// 新しい画像を保存
if ($request->hasFile('image')) {
    // 古い画像を削除
    if ($product->image) {
        Storage::delete('public/image/' . $product->image);
    }

    // 新しい画像を保存
    $dir = 'image';
    $jpg = $request->file('image')->getClientOriginalName();
    $request->file('image')->storeAs('public/' . $dir, $jpg);
    $product->image = $jpg;
}
        // 製品を保存
        $product->save();
    
        // 製品更新後にリダイレクト
        return redirect('/products');
    }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleVisibility(Int $id)
    {
        // 特定のIDに基づいて製品を取得
        $product = Product::find($id);
     
        // 製品の表示非表示を切り替える
        $product->is_visible = !$product->is_visible;
        $product->save();
        // リダイレクト
        return redirect('/products');
    }
    
    public function destroy(Request $request, $id)
    {
        $product = Product::find($id); 
        $product->delete();
        return redirect('/products');

    }

    
    }

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            管理者ページ
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <!-- 商品一覧 -->
                    <div class="card">
                        <div class="card-header">商品一覧</div>
                        <div class="card-body">
                            @if(isset($products))
                                @foreach ($products as $product)
                                <div class="card mb-3">
                                    <img src="{{ $product->image ? asset('storage/image/' . $product->image) : asset('storage/no-image.jpg') }}" class="card-img-top" alt="商品画像">
                                    <div class="card-body">
                                        <h5 class="card-title">商品名：{{ $product->name }}</h5>
                                        <p class="card-text">商品説明：{{ $product->description }}</p>
                                        <p class="card-text"><small class="text-body-secondary">金額：{{ $product->price }}円</small></p>
                                        @if ($product->is_visible === 1)
                                        <!-- 製品が非表示の場合、表示ボタンを生成 -->
                                        <form action="{{ route('products.toggleVisibility', ['id' => $product->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">表示</button>
                                        </form>
                                        @else
                                        <!-- 製品が表示中の場合、非表示ボタンを生成 -->
                                        <form action="{{ route('products.toggleVisibility', ['id' => $product->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">非表示</button>
                                        </form>
                                        @endif
                                        <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>

                                        <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-warning">編集</a>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- ユーザー一覧 -->
                    <div class="card">
                        <div class="card-header">ユーザー一覧</div>
                        <div class="card-body">
                            @if(isset($product))
                                @foreach ($user_id as $user)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">ユーザー名：{{ $user->name }}</h5>
                                        <p class="card-text">メールアドレス：{{ $user->email }}</p>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- 出品ボタン -->
                    <div class="text-center mt-3">
                        <form action="{{ route('products.create', ['product' => $product->id]) }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-danger">出品</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- 売上管理 -->
                    @foreach ($item as $cartItem)
                    <div class="card mb-3">
                        <div class="card-header">売上管理</div>
                        <img src="{{ $cartItem->Product->image ? asset('storage/image/' . $cartItem->Product->image) : asset('storage/no-image.jpg') }}" class="card-img-top" alt="カート内商品画像">
                        <div class="card-body">
                            <h5 class="card-title">{{ $cartItem->product->name }}</h5>
                            <p class="card-text">
                                <strong>個数:</strong> {{ $cartItem->product->quantity }}<br>
                                <strong>価格:</strong> {{ $cartItem->product->price }}円<br>
                                <strong>登録日:</strong> {{ $cartItem->product->created_at }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

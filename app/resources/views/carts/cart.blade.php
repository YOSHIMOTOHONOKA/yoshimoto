@extends('layouts.app')
@section('content')
<div class="container"> <!-- ヘッダー自体の幅を調整 -->
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header text-center">カート一覧</div>
        <div class="row justify-content-start">
          @foreach ($item as $cartItem)
          <div class="col-md-6 col-lg-4">
    <div class="card mb-4">
        <form action="{{ route('carts.cart', ['item' => $cartItem->id]) }}" method="POST">
            <img src="{{ $cartItem->Product->image ? asset('storage/image/' . $cartItem->Product->image) : asset('storage/no-image.jpg') }}" class="card-img-top img-fluid" alt="..." style="height: 300px;">
            <div class="card-body">
                <h5 class="card-title">商品名：　{{ $cartItem->product->name }}</h5>
                <p class="card-text">商品説明：　{{ $cartItem->product->description }}</p>
                <p class="card-text">価格： {{ $cartItem->product->price }}円</p>
                <form action="{{ route('carts.destroy', ['cart' => $cartItem->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </div>
        </form>
    </div>
</div>
          @endforeach
        </div>
        <div class="text-center"> <!-- ボタンとリンクを中央に配置 -->
          <a href="{{ route('carts.create') }}" class="btn btn-primary">注文</a> <!-- 注文ボタンを追加 -->
          <button type="button" class="btn btn-secondary" onClick="history.back()">戻る</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

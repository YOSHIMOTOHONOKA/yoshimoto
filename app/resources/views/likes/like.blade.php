@extends('layouts.app')
@section('content')
<div class="container"> <!-- ヘッダー自体の幅を調整 -->
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header text-center">いいね一覧</div>
        <div class="row justify-content-start">
          @foreach ($item as $cartItem)
            <div class="col-md-6 col-lg-4"> <!-- カードの幅を調整 -->
              <div class="card mb-4">
                <form action="{{ route('like', ['item' => $cartItem->id]) }}" method="GET">
                  <img src="{{ $cartItem->Product->image ? asset('storage/image/' . $cartItem->Product->image) : asset('storage/no-image.jpg') }}" class="card-img-top img-fluid" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">商品名：　{{ $cartItem->product->name }}</h5>
                    <p class="card-text">商品説明：　{{ $cartItem->product->description }}</p>
                    <p class="card-text">価格： {{ $cartItem->product->price }}円</p>
                  </div>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

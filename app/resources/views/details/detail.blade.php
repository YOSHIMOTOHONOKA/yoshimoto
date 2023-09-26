@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header text-center">商品詳細</div>
        <div class="container"> <!-- コンテナを追加 -->
            <div class="card mx-auto mb-4" style="max-width: 1000px;"> <!-- カードの最大幅を制限 -->
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $item->image ? asset('storage/image/' . $item->image) : asset('storage/no-image.jpg') }}" class="card-img-top" alt="...">
                        </div>
                        
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">商品名: {{ $item->name }}</h5>
                                <p class="card-text">商品説明: {{ $item->description }}</p>
                                <p class="card-text">価格: {{ $item->price }}円</p>
                                <a href="{{ route('carts.show', ['cart' => $item->id]) }}" class="btn btn-primary">カートに入れる</a>
                                <button type="button" class="btn btn-secondary" onClick="history.back()">戻る</button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <h3>レビュー一覧</h3>
            @if ($item->reviews->count() > 0)
                <ul class="list-group">
                    @foreach ($item->reviews as $review)
                        <li class="list-group-item">
                            <h4 class="card-title">タイトル: {{ $review->title }}</h4>
                            <p class="card-text">コメント: {{ $review->comment }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>この商品にはまだレビューがありません。</p>
            @endif
        </div>
    </div>
</div>
@endsection

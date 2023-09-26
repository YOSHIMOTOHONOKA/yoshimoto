@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card-header text-center">注文履歴</div>
    <div class="row justify-content-center">
        @foreach ($item as $cartItem)
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <form action="{{ route('historys.index', ['item' => $cartItem->id]) }}" method="POST">
                        <img src="{{ $cartItem->Product->image ? asset('storage/image/' . $cartItem->Product->image) : asset('storage/no-image.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $cartItem->product->name }}</h5>
                            <p class="card-text">
                                <strong>個数:</strong> {{ $cartItem->product->quantity }}<br>
                                <strong>価格:</strong> {{ $cartItem->product->price }}円<br>
                                <strong>登録日:</strong> {{ $cartItem->product->created_at }}
                            </p>
                            <a href="{{ route('reviews.edit', ['review' => $cartItem->product_id]) }}" class="btn btn-primary">レビュー投稿</a>
                            @method('PATCH')
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

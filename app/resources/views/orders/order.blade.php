@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header">注文商品</div>
        <div class="card-body">
            @foreach ($item as $order)
            <div class="card mb-3" style="max-width: 1000px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ $order->product->image ? asset('storage/image/' . $order->product->image) : asset('storage/no-image.jpg') }}" alt="Product Image" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">商品名：{{ $order->product->name }}</h5>
                            <p class="card-text">商品説明：{{ $order->product->description }}</p>
                            <p class="card-text">金額：{{ $order->product->price }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="card">
        <div class="card-header">注文フォーム</div>
        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">氏名</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="postcode" class="form-label">郵便番号</label>
                    <input type="text" class="form-control" id="postcode" name="postcode">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">住所</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>
                <div class="mb-3">
                    <label for="mailaddress" class="form-label">メールアドレス</label>
                    <input type="text" class="form-control" id="mailaddress" name="mailaddress">
                </div>
                <button type="submit" class="btn btn-primary">注文</button>
            </form>
        </div>
    </div>
</div>
@endsection

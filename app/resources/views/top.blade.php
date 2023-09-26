@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            商品一覧
        </div>
        <div class="card-body">
            <form action="{{ route('tops.index') }}" method="GET">
                @csrf
                <div class="form-row mb-3">
                    <div class="col-md-6">
                        <label for="keyword">キーワード検索</label>
                        <input type="text" class="form-control" name="keyword" id="keyword">
                    </div>
                    <div class="col-md-3">
                        <label for="from">金額範囲</label>
                        <select class="form-control" name="from" id="from">
                            <option value="">金額を選択してください</option>
                            <option value="1000" @if(1000 == $from) selected @endif>1,000円以上</option>
                            <option value="5000" @if(5000 == $from) selected @endif>5,000円以上</option>
                            <option value="10000" @if(10000 == $from) selected @endif>10,000円以上</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="until">&nbsp;</label>
                        <select class="form-control" name="until" id="until">
                            <option value="">金額を選択してください</option>
                            <option value="1000">1,000円未満</option>
                            <option value="5000">5,000円未満</option>
                            <option value="10000">10,000円未満</option>
                        </select>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">検索</button>
                </div>
            </form>
        </div>
    </div>
    @if(isset($products))
        <div class="row">
            @php
            // $products コレクションを created_at 列で降順に並べ替え
            $sortedProducts = $products->sortByDesc('created_at');
            @endphp

            @foreach ($sortedProducts as $item)
            <!-- ここから商品カードの表示 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $item->image ? asset('storage/image/' . $item->image) : asset('storage/no-image.jpg') }}" class="card-img-top" alt="..." style="height: 300px;">
                    <div class="card-body text-center">
                        <h5 class="card-title">商品名：{{ $item->name }}</h5>
                        <p class="card-text">商品説明：{{ $item->description }}</p>
                        <p class="card-text"><small class="text-muted">価格：{{ $item->price }}円</small></p>
                        <a href="{{ route('details.detail', ['item' => $item->id]) }}" class="btn btn-primary">詳細</a>

                        @if(Auth::check())
                            @if($item->getlike($item->id))
                            <a class="js-like-toggle loved" href="" data-itemid="{{ $item->id }}">❤︎</a>
                            @else
                            <a class="js-like-toggle notloved" href="" data-itemid="{{ $item->id }}">❤︎</a>
                            @endif
                            <span class="likesCount">{{ $item->likes_count }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <!-- ここまで商品カードの表示 -->
            @endforeach
        </div>
    @endif
</div>
@endsection

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品編集</div>
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $message)
                            <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">タイトル</label>
                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">本文</label>
                            <div class="col-md-9">
                                <textarea name="description" id="description" class="form-control" style="resize: none; height: 200px;">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-3 col-form-label text-md-right">価格</label>
                            <div class="col-md-9">
                                <input id="price" type="text" class="form-control" name="price" value="{{ old('price', $product->price) }}">
                            </div>
                        </div>
                        <div class="form-group row">
    <label for="image" class="col-md-3 col-form-label text-md-right">画像</label>
    <div class="col-md-9">
        <!-- 画像プレビュー -->
        @if($product->image)
        <img src="{{ asset('storage/image/' . $product->image) }}" alt="商品画像" style="max-width: 100px;">
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="image" class="col-md-3 col-form-label text-md-right">画像アップロード</label>
    <div class="col-md-9">
        <!-- ファイルアップロードフォーム -->
        <input id="image" type="file" class="form-control" name="image">
    </div>
</div>
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary" onClick="history.back()">戻る</button>
                            <button type="submit" class="btn btn-primary ml-3" name="action" value="add">
                                編集
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

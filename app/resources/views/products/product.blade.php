@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">商品登録</div>
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

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">画像</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">商品名</label>
                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-2 col-form-label text-md-right">金額</label>
                            <div class="col-md-9">
                                <input  type="text" id="price" class="form-control" name="price" value="{{ old('price') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">商品詳細</label>
                            <div class="col-md-9">
                                <textarea name="description" id="description" style="resize: none; height: 200px; width: 100%">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-secondary" onClick="history.back()">戻る</button>
                                <button type="submit" class="btn btn-primary ml-3" name='action' value='add'>
                                    登録
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

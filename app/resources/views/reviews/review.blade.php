@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">レビュー投稿</div>
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

                    <form action="{{ route('reviews.update', ['review' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="title" class="col-md-3 col-form-label text-md-right">タイトル</label>
                            <div class="col-md-9">
                                <input id="title" type="text" class="form-control" name="title">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comment" class="col-md-3 col-form-label text-md-right">コメント</label>
                            <div class="col-md-9">
                                <textarea name="comment" id="comment" class="form-control" style="resize: none; height: 200px;"></textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-3">
                                <button type="button" class="btn btn-secondary" onClick="history.back()">戻る</button>
                                <button type="submit" class="btn btn-primary ml-3" name='action' value='add'>投稿</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

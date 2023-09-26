@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">ユーザー情報</div>
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

                    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                        @method('PATCH')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">ユーザー名</label>
                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">メールアドレス</label>
                            <div class="col-md-9">
                                <textarea name="email" id="email" style="resize: none; height: 40px; width: 100%">{{ old('email', $user->email) }}</textarea>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary" onClick="history.back()">戻る</button>
                            <button type="submit" class="btn btn-primary ml-3" name='action' value='add'>
                                編集
                            </button>
                        </div>
                    </form>
                    <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">退会</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

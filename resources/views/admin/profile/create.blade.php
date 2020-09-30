{{-- layouts/profile.blade.phpを読み込む　--}}
@extends('layouts.admin')


{{-- profile.blade.phpの@yield('title')に'My プロフィール'を埋め込む　--}}
@section('title','My プロフィール')

{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む　--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>My プロフィール</h2>
                <form action="{{ action('Admin\ProfileController@create') }}" method="post"
                     enctype="multipart/form-data">
                    
                    @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group row">
                    <label class="col-md-2">氏名</label>
                    <dv class="col-md-10">
                        <input type="text" class="form-control" name="title" value=""{{ old('title') }}">
                    </dv>
                </div>
                <div class="form-group row">
                    <label class="col-md-2">性別</label>
                    <dv class="col-md-10">
                        <input type="text" class="form-control" name="gender" value=""{{ old('gender') }}">
                    </dv>
                </div>                
                <div class="form-group row">
                    <label class="col-md-2">趣味</label>
                    <dv class="col-md-10">
                        <input type="text" class="form-control" name="hobby" value=""{{ old('hobby') }}">
                    </dv>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2">自己紹介欄</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="introduction" rows="20">{{ old('introduction') }}</textarea>
                    </div>    
                </div>
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="更新">
                </form>

            </div>
        </div>
    </div>
@endsection

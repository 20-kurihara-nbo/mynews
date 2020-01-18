@extends('layouts.profile')

@section('title','プロフィール情報')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール情報</h2>
                <form action="{{ action('ProfileController@index') }}" method="post" enctype="multipart/form-date">
                    
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach    
                        </ul>
                    @endif
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="name">氏名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $profile_form->name }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2" for="gender">性別</label>
                        <div class="col-md-10 form-inline">
                            <input type="radio" class="form-control" name="gender" value="man" checked>男性
                            <input type="radio" class="form-control" name="gender" value="woman">女性
                        </div>
                    </div>

　　　　　　　　　　<div class="form-group row">
                        <label class="col-md-2" for="hobby">趣味</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="hobby" value="{{ $profile_form->hobby }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2" for="introduction">自己紹介</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="10">{{ $profile_form->introduction }}</textarea>
                        </div>
                    </div>
                     
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                    
                </form> 
                {{-- 以下を追記　--}}
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($profile_form->profileedit != NULL)
                                @foreach ($profile_form->profileedit as $profileedit)
                                    <li class="list-group-item">{{ $profileedit->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
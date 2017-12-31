@extends('layouts.home') @section('title','个人中心') @section('content')

@include('home.share._user_menu')
<div class="col-md-9 user-info-modify">
	<h2>基本信息修改</h2>
	<hr>
	@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
    <form method="post" class="col-md-7" action="{{route('user-setting')}}" enctype="multipart/form-data">
        <div class="form-group ">
            <label for="exampleInputEmail1">邮箱</label>
            <input type="name" name="email" class="form-control" value="{{$user->email}}" id="exampleInputEmail1" placeholder="Email">
        </div>
       
        <div class="form-group">
        	<img src="{{$user->profile}}" width="200"><br>
            <label for="exampleInputFile">头像</label>
            <input type="file" id="exampleInputFile" name="profile">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@stop
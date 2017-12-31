@extends('layouts.home') @section('title','个人中心') @section('content')

@include('home.share._user_menu')
<div class="col-md-9 user-info-modify">
	<h2>修改密码</h2>
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
    <form method="post" class="col-md-7" action="{{route('set-password')}}">
        <div class="form-group ">
            <label>原密码</label>
            <input type="password" name="old_password" class="form-control" value="" placeholder="">
        </div>
       <div class="form-group ">
            <label>新密码</label>
            <input type="password" name="new_password" class="form-control" value="" placeholder="">
        </div>
        <div class="form-group ">
            <label>确认密码</label>
            <input type="password" name="re_password" class="form-control" value="" placeholder="">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary">修改密码</button>
    </form>
</div>
@stop
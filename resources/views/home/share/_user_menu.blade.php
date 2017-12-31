<div class="col-md-3">
    <div class="list-group">
        <a href="{{route('user-setting')}}" class="list-group-item @if(request()->url() == route('user-setting')) active  @endif">
		    基本信息
		</a>
        <a href="{{route('set-password')}}" class="list-group-item @if(request()->url() == route('set-password')) active  @endif">
		    修改密码
		</a>
    </div>
</div>
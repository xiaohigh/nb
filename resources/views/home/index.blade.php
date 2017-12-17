@extends('layouts.home')

@section('container')
<div id="big-screen">
    <div class="clearfix"></div>
    <div id="particles-js"></div>
    <h1 class="text-center">知识改变命运，技术改变生活</h1>
</div>
<div class="container cuojues">
    <hr class="hr-text" data-content="人生三大错觉">
    <div class="col-md-4">
        <div class="cuojue">
            <div class="icon"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></div>
            <p>这东西特么的好简单啊</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="cuojue">
            <div class="icon"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></div>
            <p>这东西练一遍就会了</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="cuojue">
            <div class="icon"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></div>
            <p>我太帅了</p>
        </div>
    </div>
    <div class="clearfix"></div>
    <hr class="hr-text" data-content="复杂的事情简单做，简单的事情重复做，重复的事情用心做">
</div>
@stop


@section('title', '首页')

@section('js')
<script src="/bower_components/particles.js/particles.min.js"></script>
<script src="/js/particles.js"></script>
@stop

@section('css')
<link rel="stylesheet" href="/css/particles.css">
@stop

@section('search')
@stop
@extends('layouts.home')

@section('container')
    <style>
        body{
            background: #000;
        }
    </style>
    <div class="video container">

        <div class="col-md-10 col-md-offset-1">
            <video src="http://ods3iz6u4.bkt.clouddn.com/1.mov" width="100%" controls></video>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="col-md-6 col-md-offset-3">
            <div class="lessons">
                <div class="list-group">
                    <a href="#" class="list-group-item"><span class="glyphicon glyphicon-play-circle" aria-hidden="true" style="padding-right:10px;"></span>节视频将为大</a>
                    <a href="#" class="list-group-item"><span class="glyphicon glyphicon-play-circle" aria-hidden="true" style="padding-right:10px;"></span>Dapibus ac facilisis in</a>
                    <a href="#" class="list-group-item"><span class="glyphicon glyphicon-play-circle" aria-hidden="true" style="padding-right:10px;"></span>Dapibus ac facilisis in</a>
                    <a href="#" class="list-group-item"><span class="glyphicon glyphicon-play-circle" aria-hidden="true" style="padding-right:10px;"></span>Dapibus ac facilisis in</a>
                </div>
            </div>
        </div>
    </div>
@stop
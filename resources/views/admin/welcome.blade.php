@extends('admin.master')


@section('content')
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>


        .content-wrapper, .right-side {
            min-height: 100%;
            background-color: #fff;
            z-index: 800;
        }
        .title {
            font-size: 84px;
            text-align: center;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
        }
    </style>
    <div class="title m-b-md">
        OSULA MEDICARE MANAGEMENT SYSTEM
        <img src="{{asset('img/logo.jpg')}}" style="width: 211px">
    </div>

@stop
@extends('article.layouts')

@section('content')

    @include('article.validator')

    <div class="panel panel-default">
        <div class="panel-heading">添加文章</div>
        <div class="panel-body">
            @include('article._form')
        </div>
    </div>
@stop
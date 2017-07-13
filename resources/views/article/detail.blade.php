@extends('article.layouts')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">文章详情</div>

        <div style="text-align: center;display: inline-block;" class="col-md-12">
            <p>{{$article->title}}</p>
            <p>
                <span>作者：</span><span>{{$author}}</span>&nbsp;&nbsp;&nbsp;<span>日期：</span><span>{{$article->created_at}}</span>
            </p>
            <div style="margin-bottom: 20px">
                {{$article->content}}
            </div>

        </div>
    </div>
@stop
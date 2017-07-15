@extends('layouts.app')

@section('content')


    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">文章列表</div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>序号</th>
                <th>标题</th>
                <th>添加时间</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($articles as $key=>$article)
                <tr>
                    <th scope="row">{{ $i++}}</th>
                    <td><a href="{{route('comment.show',['id'=>$article->id])}}">{{ $article->title }}</a></td>
                    {{--因为数据库中有的是时间戳，有的是格式化之后的日期，所以使用date函数时报错了--}}
                    <td>{{$article->created_at}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- 分页  -->
    <div>
        <div class="pull-right">
            {{ $articles->render() }}
        </div>

    </div>
@stop
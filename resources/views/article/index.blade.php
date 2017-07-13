@extends('article.layouts')

@section('content')

    @include('article.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">文章列表</div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>标题</th>
                <th>作者</th>
                <th>添加时间</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($articles as $key=>$article)
                <tr>
                    <th scope="row">{{ $article->id }}</th>
                    <td>{{ $article->title }}</td>
                    <td>{{$article->authorid}}</td>
                    {{--因为数据库中有的是时间戳，有的是格式化之后的日期，所以使用date函数时报错了--}}
                    <td>{{$article->created_at}}</td>
                    <td>
                        <a href="{{ route('article.show',['post'=>$article->id]) }}">详情</a>
                        <a href="{{ route('article.edit',['post'=>$article->id]) }}">修改</a>
                        <a href="{{ route('article.delete',['post'=>$article->id]) }}"
                           onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>
                    </td>
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
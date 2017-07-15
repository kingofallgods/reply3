@extends('article.layouts')

@section('content')

    @include('article.message')
<style>
    .delete:focus,.delete:hover{color:#23527c;text-decoration:underline;outline: none;}
</style>
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
                    <td>{{$author}}</td>
                    {{--因为数据库中有的是时间戳，有的是格式化之后的日期，所以使用date函数时报错了--}}
                    <td>{{$article->created_at}}</td>
                    <td>
                        <a href="{{ route('article.show',['article'=>$article->id]) }}">详情</a>
                        <a href="{{ route('article.edit',['article'=>$article->id]) }}">修改</a>
                        <form method="post" action="{{ route('article.destroy',['article'=>$article->id]) }}" accept-charset="utf-8" id="subform" style=" display: inline-block">
                            <input name="_method" type="hidden" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button onclick="if (confirm('确定要删除吗？') == false) return false;"
                                    style="background: inherit;border: none;color: #337ab7;outline: none;" class="delete"> 删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <script type="text/javascript" src="{{ asset('jquery/jquery.min.js') }}"></script>

    </div>

    <!-- 分页  -->
    <div>
        <div class="pull-right">
            {{ $articles->render() }}
        </div>

    </div>
@stop
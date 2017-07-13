@extends('article.layouts')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">文章详情</div>

        <div style="text-align: center;display: inline-block;" class="col-md-12">
            <p>{{$article->title}}</p>
            <p>
                <span>作者：</span><span>{{$article->authorid}}</span>&nbsp;&nbsp;&nbsp;<span>日期：</span><span>{{$article->created_at}}</span>
            </p>
            <div style="margin-bottom: 20px">
                {{$article->content}}
            </div>
            <div style="width: 100%;margin-bottom: 20px;border-top: 2px solid #333">
                <form method="post" action="" class="form-horizontal">
                    <div class="form-group">


                        <div class="col-sm-7">
                           <textarea style="width: 100%;height: 120px;margin-top: 20px">

                </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">提交评论</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
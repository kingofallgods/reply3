@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div style="text-align: center;display: inline-block;" class="col-md-12">
                        <p>{{$article->title}}</p>
                        <p>
                            <span>作者：</span><span>{{$article->name}}</span>&nbsp;&nbsp;&nbsp;<span>日期：</span><span>{{$article->created_at}}</span>
                        </p>
                        <div style="margin-bottom: 20px">
                            {{$article->content}}
                        </div>
                        <div style="width: 100%;margin-bottom: 20px;border-top: 2px solid #333;text-align: left">
                           <p style="margin:10px 10px;height: 30px;line-height: 30px;color: #1f648b;font-size: 18px;font-weight: bold">评论区</p>
                            @foreach($comment as $comm)
                                <div style="{{$comm['lev']==1? 'width: 100%;margin:20px 0;' :'width: '.(100-$comm['lev']*5).'%;margin-left:'.($comm['lev']*5).'%;'}}border: 1px solid #2ca02c;text-align: left" class="comm">
                                    <input type="hidden" class="commid" value="{{$comm['id']}}">
                                    <div>
                                        <span style="font-size: 16px;color: #2ca02c;font-weight: bold" class="commname">{{$comm['name']}}</span>：
                                        <button class="hf">回复</button>
                                        <span style="float: right">{{$comm['created_at']}}</span>
                                    </div>
                                    <div>
                                        {{$comm['content']}}
                                    </div>
                                </div>
                                <br/>
                            @endforeach
                        </div>
                        <div style="width: 100%;margin-bottom: 20px;border-top: 2px solid #333">
                            <form method="post" action="{{route('comment.create')}}" class="form-horizontal">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$id}}" name="articleid">
                                <input type="hidden" value="{{$userid}}" name="userid">
                                <input type="hidden" value="0" name="parent" id="parent">
                                <div class="form-group">


                                    <div class="col-sm-7">
                           <textarea style="width: 100%;height: 120px;margin-top: 20px" name="content" id="content">

                </textarea>
                                    </div>
                                    @if ($errors->has('content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary">提交评论</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script type="text/javascript" src="{{ asset('jquery/jquery.min.js') }}"></script>
<script type="text/javascript">
$(function () {
    $('.hf').on('click',function () {
        $commid=  $(this).parent().parent('.comm').children(".commid").val();
        $('#parent').val($commid);
        $('#content').focus();
    })
})
</script>
                </div>
            </div>
        </div>
    </div>
@endsection

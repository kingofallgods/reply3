<form class="form-horizontal" method="post" action="{{$postUrl}}">

    {{ csrf_field() }}
    @if(Request::getPathInfo() != '/article/create')
    <input type="hidden" name="_method" value="PUT"/>
    @endif

    @if(Request::getPathInfo() == '/article/create')
        <input type="hidden" name="token" value="{{$token}}"/>
    @endif

    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">文章标题</label>

        <div class="col-sm-5">
            <input type="text" name="title"
                   value="{{isset($article)?$article->title:old('title') }}"
                   class="form-control" id="title" placeholder="文章标题">
        </div>
    </div>
    <div class="form-group">
        <label for="content" class="col-sm-2 control-label">文章内容</label>

        <div class="col-sm-5">

            <textarea name="content" value=""
            class="form-control" id="content" style="width:650px;height: 320px">{{isset($article)?$article->content:old('content')}}</textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </div>
</form>
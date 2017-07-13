<form class="form-horizontal" method="POST" action="{{url('upload')}}" enctype="multipart/form-data" id="form1">

    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('avatar1') ? ' has-error' : '' }}">
        <label for="avatar1" class="col-md-4 control-label">请上传头像</label>

        <div class="col-md-6">
            <input id="avatar1" type="file" class="form-control" name="avatar1"  value="{{ old('avatar1') }}" required>

            @if (Session::has('filepath'))
                <span class="help-block">
                                        <img src="{{ Session::get('filepath') }}" style="height: 200px;width: 150px">
                                    </span>
            @elseif(isset($user->avatar)&&!Session::has('filepath'))
                <span class="help-block">
                <img src="{{ $user->avatar }}" style="height: 200px;width: 150px">
                </span>
                @else
            @endif
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <button class="btn btn-primary" id="sub1" type="submit">
                点击上传头像
            </button>


        </div>
    </div>

</form>
<form class="form-horizontal" method="POST" action="" id="form">
    {{ csrf_field() }}
    @if (Session::has('filepath'))
    <input type="hidden" value="{{ Session::get('filepath') }}" name="avatar">
    @elseif(isset($user->avatar)&&!Session::has('filepath'))
        <input type="hidden" value="{{ $user->avatar }}" name="avatar">
    @else

    @endif

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">姓名</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name')?old('name'):(isset($user->name)?$user->name:'') }}" required autofocus>

            @if ($errors->has('name'))
            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">邮箱地址</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{old('email')?old('email'):(isset($user->email)?$user->email:'')}}" required>

            @if ($errors->has('email'))
            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
        </div>
    </div>
@if(Request::getPathInfo()=='/register')
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-4 control-label">密码</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="password-confirm" class="col-md-4 control-label">确认密码</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button class="btn btn-primary" id="sub">
                注册
            </button>
        </div>
    </div>
@else
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button class="btn btn-primary" id="sub">
                    保存修改
                </button>
            </div>
        </div>
    @endif
</form>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <table class="table table-striped table-hover table-responsive" border="1">
                        <thead>
                        <tr>
                            <td colspan="2" align="center">个人资料</td>
                        </tr>
                        </thead>
                        <tr>
                            <td>id</td>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <td>avatar</td>
                            <td><img src="{{ $user->avatar }}" style="height: 200px;width: 150px"></td>
                        </tr>
                        <tr>
                            <td>name</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td>{{ $user->email }}</td>
                        </tr>

                        <tr>
                            <td colspan="2" align="center"><a
                                        href="{{ url('user/update', ['id' => $user->id]) }}">修改资料</a></td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

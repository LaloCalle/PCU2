@extends('layouts.auth')

@section('content')
    <div class="content">
            <img src="{!!URL::to('/images/logo.svg')!!}">
            {!!Form::open(['route'=>'login.store', 'method'=>'POST'])!!}
              {!! csrf_field() !!}
              <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
                    {!!Form::text('username',old('username'),['class'=>'form-control', 'placeholder'=>trans('strings.username')])!!}
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
                    {!!Form::password('password',['class'=>'form-control', 'placeholder'=>trans('strings.password')])!!}
                </div>
              </div>
              <button type="submit" class="btn btn-default">{{ trans('strings.login') }}</button>
              <div class="form-group recovery-pass">
                {!!link_to('password/email',$title=trans('strings.passwordquestion'),$attributes = null, $secure = null)!!}
              </div>
            {!!Form::close()!!}
    </div>
@endsection
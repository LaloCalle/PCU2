@extends('layouts.auth')

@section('content')
    <div class="content">
            <img src="{!!URL::to('/images/logo.svg')!!}">
            {!!Form::open(['url'=>'/password/reset'])!!}
              {!!Form::hidden('token',$token,null)!!}
              <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
                    {!!Form::text('email',null,['class'=>'form-control', 'placeholder'=>trans('strings.email'),'value'=>"{{old('email')}}"])!!}
                </div>
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
                    {!!Form::password('password',['class'=>'form-control', 'placeholder'=>trans('strings.password')])!!}
                </div>
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
                    {!!Form::password('password_confirmation',['class'=>'form-control', 'placeholder'=>trans('strings.passwordconfirm')])!!}
                </div>
              </div>
              <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span> {{ trans('strings.resetpassword') }}</button>
    </div>
@endsection
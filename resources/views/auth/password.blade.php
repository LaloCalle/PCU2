@extends('layouts.auth')

@section('content')
    <div class="content">
            <img src="{!!URL::to('/images/logo.svg')!!}">
            {!!Form::open(['url'=>'password/email'])!!}
              <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
                    {!!Form::email('email',null,['class'=>'form-control', 'placeholder'=>trans('strings.insertmail')])!!}
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-default">{{ trans('strings.sendlink') }}</button>
              </div>
            {!!Form::close()!!}
    </div>
@endsection